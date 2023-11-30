<?php

namespace App\Models;

use App\Traits\Productable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    use Productable;

    protected $fillable = ['image_path','imageable_id','imageable_type'];

    public function imageable()
    {
        return $this->morphTo();
    }

}
