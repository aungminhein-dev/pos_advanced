<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\Size;
use App\Models\Brand;
use App\Models\Event;
use App\Models\Colour;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Discount;
use App\Models\SubCategory;
use App\Models\Notification;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'quantity', 'price', 'rating', 'sub_category_id','slug','view_count','brand_id'];



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
        return $this->hasMany(Size::class);
    }

    // colour relatonships
    public function colours()
    {
        return $this->hasMany(Colour::class);
    }

    // image relationship
    public function images()
    {
        return $this->morphMany(Image::class,'imageable');
    }

    // discounts
    public function discount()
    {
        return $this->hasOne(Discount::class);
    }

    public function tags()
    {
        return $this->morphMany(Tag::class,'taggable');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class,'notifiable');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeDetailsBySlug($query,$slug)
    {
        return $query->where('slug', $slug)->with(['subCategory', 'sizes', 'colours', 'images', 'discount', 'tags','comments'])->first();
    }
}

