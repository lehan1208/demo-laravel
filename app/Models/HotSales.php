<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotSales extends Model
{
    use HasFactory;
    protected $table = 'hot_sales';
    protected $primaryKey = 'id';
    
    public $timestamps = false;
}
