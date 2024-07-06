<?php

namespace App\Livewire\User;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;

class ProductSwitch extends Component
{
    public bool $popularItems = false;
    public bool $discountItems = false;
    public bool $allProducts = true;

    public function popularItem()
    {
        $this->resetFlags();
        $this->popularItems = true;
    }

    public function discountItem()
    {
        $this->resetFlags();
        $this->discountItems = true;
    }

    public function showAllProducts()
    {
        $this->resetFlags();
        $this->allProducts = true;
    }

    private function resetFlags()
    {
        $this->popularItems = false;
        $this->discountItems = false;
        $this->allProducts = false;
    }



    public function render()
    {
        switch (true) {
            case $this->discountItems:
                $products = Product::with(['subCategory', 'category', 'discount', 'images'])
                    ->has('discount')
                    ->get();
                break;
            case $this->popularItems:
                $products = Product::with('subCategory', 'category', 'discount', 'images')
                    ->orderBy('view_count', 'desc')
                    ->take(10)
                    ->get();
                break;
            default:
                $products = Product::with('subCategory', 'category', 'discount', 'images')->take(10)->get();
        }

        return view('livewire.user.product-switch', compact('products'));
    }

    // add to cart
     // add to cart
     public function addToCart($id,CartService $cartService)
     {
         $cartService->addToCart($id);
         $this->dispatch('addedToCart');
     }

}
