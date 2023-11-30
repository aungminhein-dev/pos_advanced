<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Event;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class GuestController extends Controller
{

    //home
    public function home()
    {
        $brands = Brand::get();
        $categories = Category::with('image')->get();
        $events = Event::with([
            'image',
            'products' => function ($query) {
                $query->with('subCategory');
            },
            'discounts' => function ($query) {
                $query->select('percentage', 'event_id')
                    ->orderBy('percentage', 'desc');
            },
        ])->get();
        $products = Product::with('subCategory', 'category', 'discount', 'images')->get()->take(10);
        $newProducts = Product::with('subCategory','category','discount','images')->where('arrival_status','New')->get()->take(10);
        $popularProducts = Product::with('subCategory', 'category', 'discount', 'images')->orderBy('view_count', 'desc')->get()->take(10);
        $discountedProducts = Product::with(['subCategory', 'category', 'discount', 'images'])
            ->has('discount')
            ->get();


        // dd($products->toArray());
        return view('user.index', compact('brands', 'categories', 'events', 'products', 'popularProducts', 'discountedProducts','newProducts'));
    }

    // about
    public function about()
    {
        return view('user.about');
    }

    // shop
    public function shop()
    {
        return view('user.shop');
    }

    // contact
    public function contact()
    {
        return view('user.contact');
    }

    // blog
    public function blog()
    {
        return view('user.blog');
    }

    // privacy
    public function privacy()
    {
        return view('user.privacy');
    }

    // loginPage
    public function loginPage()
    {
        return view('login');
    }

    // register Page
    public function registerPage()
    {
        return view('register');
    }
}
