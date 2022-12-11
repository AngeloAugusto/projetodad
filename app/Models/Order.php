<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->hasMany(Product::class, 'order_items');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function delivered_by()
    {
        return $this->belongsTo(User::class, 'delivered_by');
    }
}
