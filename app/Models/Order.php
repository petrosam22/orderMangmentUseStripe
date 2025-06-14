<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
        protected $guarded = ['id'];


        
public function products()
{
    return $this->belongsToMany(Product::class)
                ->withPivot('quantity', 'price')
                ->withTimestamps();
}

}
