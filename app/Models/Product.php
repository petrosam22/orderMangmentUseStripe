<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
       protected $guarded = ['id'];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

  public function orders()
{
    return $this->belongsToMany(Order::class)
                ->withPivot('quantity', 'price')
                ->withTimestamps();
}


    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
    public function getVideoUrlAttribute()
    {
        return $this->video ? asset('storage/' . $this->video) : null;
    }
}
