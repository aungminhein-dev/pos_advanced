<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rating;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Services\ProductService;
use Illuminate\Support\Facades\Auth;

class UserHomeController extends Controller
{
    protected $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    public function details($slug)
    {
        $product = $this->productService->productDetails($slug);
        $categories = Category::all();
        $comments = Comment::with('user.ratings')->where('product_id', $product->id)->get();
        $relatedProducts = Product::with('subCategory','category','brand','discount','ratings','images')->where('id','!=',$product->id)->get();
        return view('user.product-details',compact('product','categories','comments','relatedProducts'));
    }

    public function userDashboard(OrderService $orderService)
    {
        $orders = $orderService->getOrder(Auth::user()->id);
        return view('user.dashboard',compact('orders'));
    }

    public function orderDetailList(OrderService $orderService,$orderId)
    {
        $order = $orderService->getOrderDetails($orderId);
        return view('user.order-details',compact('order'));
    }
}
