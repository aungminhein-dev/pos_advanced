<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Brand;
use App\Models\Event;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{

    public function home()
    {
        // Fetch brands
        $brands = Brand::get();

        // Fetch categories with images
        $categories = Category::with('image')->get();

        // Fetch events with images, products with subCategory, and discounts
        $events = Event::with([
            'image',
            'products.subCategory',
            'discounts' => function ($query) {
                $query->select('percentage', 'event_id')
                    ->orderBy('percentage', 'desc');
            },
        ])->get();

        // Fetch top 10 products with subCategory, category, discount, and images
        $products = Product::with('subCategory', 'category', 'discount', 'images')->take(10)->get();

        // Fetch top 10 new products with subCategory, category, discount, and images
        $newProducts = Product::with('subCategory', 'category', 'discount', 'images')
            ->where('arrival_status', 'New')
            ->take(10)
            ->get();

        // Fetch top 10 popular products with subCategory, category, discount, and images
        $popularProducts = Product::with('subCategory', 'category', 'discount', 'images')
            ->orderBy('view_count', 'desc')
            ->take(10)
            ->get();

        // Fetch discounted products with subCategory, category, discount, and images
        $discountedProducts = Product::with(['subCategory', 'category', 'discount', 'images'])
            ->has('discount')
            ->get();


        // Return view with compacted data
        return view('user.index', compact(
            'brands',
            'categories',
            'events',
            'products',
            'popularProducts',
            'discountedProducts',
            'newProducts'

        ));
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
