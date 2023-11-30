<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $guarded= [];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class,'imageable');
    }

    public function discounts()
    {
        return $this->belongsToMany(Discount::class);
    }
}
