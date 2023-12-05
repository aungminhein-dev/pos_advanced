<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','slug'];

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class,SubCategory::class,'category_id','sub_category_id','id','id');
    }

    public function image()
    {
        return $this->morphOne(Image::class,'imageable');
    }

    public function tag()
    {
        return $this->morphOne(Tag::class,'taggable');
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class,'notifiable');
    }
}
