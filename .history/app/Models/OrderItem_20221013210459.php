<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'order_id',
        'PRO_ID',
        'name',
        'price',
        'amount'
    ];

    public function order() {
        return $this->belongsTo(Order::class, 'id', 'order_id');
    }
}
