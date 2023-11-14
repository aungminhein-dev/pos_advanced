<?php

namespace App\Models;

use App\Traits\Productable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductColour extends Model
{
    use HasFactory;
    use Productable;
    protected $fillable = ["product_id","colour"];
}
