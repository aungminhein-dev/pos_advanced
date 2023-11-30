<?php

namespace App\Models;

use App\Traits\Productable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Size extends Model
{
    use HasFactory;

    // product relationships
    use Productable;
    protected $fillable = ['product_id','size'];


}
