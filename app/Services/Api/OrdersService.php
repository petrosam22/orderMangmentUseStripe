<?php

namespace App\Services\Api;

use App\Repositories\Api\Contracts\OrdersRepositoryInterface;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class OrdersService
{
    protected $ordersRepository;

    public function __construct(OrdersRepositoryInterface $ordersRepository)
    {
        $this->ordersRepository = $ordersRepository;
    }
 public function processOrder(array $data)
{
    $productsData = $data['products'];
    $customerName = $data['customer_name'];
    $paymentMethodId = $data['payment_method_id'];

    $orderItems = $this->buildOrderItems($productsData);
    $totalAmount = $this->calculateTotal($orderItems);

    $this->processStripePayment($paymentMethodId, $totalAmount);

    return $this->storeOrderWithProducts($customerName, $totalAmount, $orderItems);
}
private function buildOrderItems(array $productsData): array
{
    $items = [];

    foreach ($productsData as $item) {
        $product = Product::findOrFail($item['id']);
        $items[] = [
            'product_id' => $product->id,
            'quantity' => $item['qty'],
            'price' => $product->price,
        ];
    }

    return $items;
}
private function calculateTotal(array $items): float
{
    return collect($items)->reduce(function ($carry, $item) {
        return $carry + ($item['price'] * $item['quantity']);
    }, 0);
}
private function processStripePayment(string $paymentMethodId, float $totalAmount): void
{
    Stripe::setApiKey(config('services.stripe.secret'));

    $intent = PaymentIntent::create([
        'amount' => $totalAmount * 100,
        'currency' => 'usd',
        'payment_method' => $paymentMethodId,
        'confirm' => true,
        'automatic_payment_methods' => [
            'enabled' => true,
            'allow_redirects' => 'never',
        ],
    ]);

    if ($intent->status !== 'succeeded') {
        throw new \Exception('Payment failed');
    }
}
private function storeOrderWithProducts(string $customerName, float $totalAmount, array $items)
{
    return DB::transaction(function () use ($customerName, $totalAmount, $items) {
        $order = $this->ordersRepository->createOrder([
            'customer_name' => $customerName,
            'total_price' => $totalAmount,
            'status' => 'received',
        ]);

        foreach ($items as $item) {
            $order->products()->attach($item['product_id'], [
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        return $order;
    });
}

}
