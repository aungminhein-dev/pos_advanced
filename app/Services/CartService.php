<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartService {


    public function cartList()
    {
       return Cart::where('user_id', Auth::user()->id)->with(['product','product.brand','product.images','product.discount', 'user'])->get();
    }

    public function updateCart($request)
    {
        $data = $request->all();
        foreach ($data as $key => $value) {
            $cartItem = Cart::find($key);
            if ($cartItem) {
                $cartItem->quantity = $value;
                $cartItem->save();
            }
        }
        toastr()->success('Cart updated successfully');
    }

    public function addToCart($id,$quantity = 1)
    {
        if (Auth::user()) {
            $product = Product::where('id', $id)->with('discount')->first();

            $cartItem = [
                'user_id' => Auth::user()->id,
                'product_id' => $id,
                'quantity' => $quantity,
                'subtotal' => calculated_subtotal($product->price, $quantity, $product->discount),
            ];

            if ($product->quantity < $cartItem['quantity']) {
                toastr()->error('Out of stock', 'Error!');
                return; // Exit the function if the requested quantity exceeds available quantity
            }

            // Check if the product already exists in the cart
            $existingCartItem = Cart::where('user_id', Auth::user()->id)
                ->where('product_id', $id)
                ->first();

            if ($existingCartItem) {
                // If the product already exists in the cart, update its quantity
                $existingCartItem->update([
                    'quantity' => $existingCartItem->quantity + $cartItem['quantity']
                ]);
            } else {
                Cart::create($cartItem);
            }
            $newQuantity = $product->quantity - $cartItem['quantity'];
            $product->update([
                'quantity' => $newQuantity
            ]);
            toastr()->success('An item added to cart!', 'Success!', ['timeOut' => 5000]);
        } else {
            toastr()->warning('Please log in first to continue.', 'Alert!', ['timeOut' => 5000]);
        }
    }
}
