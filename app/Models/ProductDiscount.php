<?php

namespace App\Models;

use App\Traits\Productable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDiscount extends Model
{
    use HasFactory;
    use Productable;

    protected $fillable = ['product_id','percentage'];
}
