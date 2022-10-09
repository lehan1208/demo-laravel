<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;
    protected $table = 'product_types';
    protected $primaryKey = 'TYPE_ID';

    public $timestamps = false;

    public function products()
    {
        return $this->hasMany(Product::class, 'TYPE_ID', 'TYPE_ID');
    }
}
