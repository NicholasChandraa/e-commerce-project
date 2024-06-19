<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image',
    ];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function reduceStock($quantity)
    {
        $this->stock -= $quantity;
        $this->save();
    }
}
