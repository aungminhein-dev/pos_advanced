<?php

namespace App\Traits;

use App\Models\Product;

trait Productable {
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
