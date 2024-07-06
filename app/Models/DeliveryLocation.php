<?php

namespace App\Models;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeliveryLocation extends Model
{
    use HasFactory;

    protected $fillable = ['name','price','status','gate_fee_status','gate_fee'];

    public function notifications()
    {
        return $this->morphMany(Notification::class,'notifiable');
    }

    public function activityLog()
    {
        return $this->morphMany(ActivityLog::class,'loggable');
    }
}
