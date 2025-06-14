<?php

namespace App\Services\Api;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\ProductRequest;
use Intervention\Image\Facades\Image;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Api\Contracts\ProductsRepositoryInterface;

class ProductsService
{
    protected $productsRepository;

    public function __construct(ProductsRepositoryInterface $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }

    public function getProducts()
    {
        return  ProductResource::collection($this->productsRepository->getProducts());
    }



    public function searchProduct($name)
    {
        return ProductResource::collection(
            $this->productsRepository->searchProduct($name)
        );
    }
public function create(ProductRequest $request)
{
    $adminId = auth('admin')->id();
    $data = $request->validated();
    $data['admin_id'] = $adminId;

    $this->handleProductCreation($data, $request);

    return response()->json(['message' => 'Product Created Successfully']);
}
public function handleProductCreation(array $data, Request $request): void
{
    if ($request->hasFile('image')) {
        $data['image'] = $this->processImage($request->file('image'));
    }

    if ($request->hasFile('video')) {
        $data['video'] = $this->processVideo($request->file('video'));
    }

    $this->productsRepository->store($data);
}
private function processImage(UploadedFile $image): string
{
    $imageResource = imagecreatefromstring(file_get_contents($image->getRealPath()));

    $newWidth = 800;
    $originalWidth = imagesx($imageResource);
    $originalHeight = imagesy($imageResource);
    $newHeight = intval(($originalHeight / $originalWidth) * $newWidth);

    $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($resizedImage, $imageResource, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);

    ob_start();
    imagejpeg($resizedImage, null, 50);
    $imageContent = ob_get_clean();

    $filename = 'products/images/' . uniqid() . '.jpg';
    Storage::disk('public')->put($filename, $imageContent);

    return $filename;
}

private function processVideo(UploadedFile $video): string
{
    return $video->store('products/videos', 'public');
}


}
