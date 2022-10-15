<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SideDish extends Model
{
    use HasFactory;
    protected $table = 'side_dish';
    protected $primaryKey = 'id';

    public $timestamps = false;
}
