<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductTag;
use App\Models\ProductSize;
use App\Models\SubCategory;
use App\Models\ProductImage;
use App\Models\ProductColour;
use App\Models\ProductDiscount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'quantity', 'price', 'rating', 'sub_category_id','slug','view_count'];



    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function category()
    {
        return $this->hasOneThrough(
            Category::class,
            SubCategory::class,
            'id', // Foreign key on SubCategory table
            'id', // Foreign key on Category table
            'sub_category_id', // Local key on Product table
            'category_id' // Local key on SubCategory table
        );
    }



    public function sizes()
    {
        return $this->hasMany(ProductSize::class);
    }

    // colour relatonships
    public function colours()
    {
        return $this->hasMany(ProductColour::class);
    }

    // image relationship
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    // discounts
    public function discount()
    {
        return $this->hasOne(ProductDiscount::class,'product_id','id');
    }

    public function tags()
    {
        return $this->hasMany(ProductTag::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
