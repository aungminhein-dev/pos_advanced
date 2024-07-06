<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','slug','category_id','name'];

    // category relationship
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // product relationships
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function activityLog()
    {
        return $this->morphMany(ActivityLog::class,'loggable');
    }
}
