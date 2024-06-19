<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];
}
