<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'code',
        'name',
        'email',
        'phone',
        'address',
        'total_price',
        'status',
        'user_id',
    ];

    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
