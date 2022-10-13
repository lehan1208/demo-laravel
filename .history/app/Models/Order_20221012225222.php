<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'username',
        'name',
        'phone',
        'address',
        'shipping_fee',
        'sub_total',
        'total',
        'status',
        'reject_reason',
        'note',
        'method_payment',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
}
