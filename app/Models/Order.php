<?php

namespace App\Models;

use App\Models\User;
use App\Models\OrderDetail;
use App\Models\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'status', 'email', 'phone', 'payment_account_name', 'payment_process_number', 'address', 'location_link', 'delivery_price', 'total_with_delivery_price', 'total', 'order_code'];


    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class, OrderDetail::class, 'order_id', 'id', 'id', 'product_id');
    }

    public function activityLog()
    {
        return $this->morphMany(ActivityLog::class,'loggable');
    }
}
