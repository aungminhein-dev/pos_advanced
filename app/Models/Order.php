<?php

namespace App\Models;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','status','email','phone','payment_account_name','payment_process_number','address','location_link','delivery_price','total_with_delivery_price','total'];


    public function notifications()
    {
        return $this->morphMany(Notification::class,'notifiable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
