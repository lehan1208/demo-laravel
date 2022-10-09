<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'PRO_ID';
    
    public $timestamps = false;

    public function productType() {
        return $this->belongsTo(ProductType::class, 'TYPE_ID', 'TYPE_ID');
    }
}
