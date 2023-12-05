<?php

namespace App\Models;

use App\Traits\Productable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    use Productable;
    protected $fillable = ['product_id','percentage','start_date','end_date'];

    public function isActive()
    {
        return now() >= $this->start_date && now() <= $this->end_date;
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class,'notifiable');
    }
}
