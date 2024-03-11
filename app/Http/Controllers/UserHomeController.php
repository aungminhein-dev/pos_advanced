<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class UserHomeController extends Controller
{

    public function details($slug)
    {
        $product = Product::query()->detailsBySlug($slug);
        return view('user.product-details',compact('product'));
    }
}
