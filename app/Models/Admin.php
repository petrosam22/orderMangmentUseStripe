<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
class Admin extends Authenticatable
{

        use HasApiTokens, Notifiable;

    use HasFactory;
        protected $fillable = [
        'name',
        'email',
        'password',
    ];

      protected $hidden = [
        'password',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
