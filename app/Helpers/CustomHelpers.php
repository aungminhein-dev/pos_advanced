<?php

use App\Models\Cart;
use App\Models\Product;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

if(!function_exists('discounted_price')){
    function discounted_price($original_price,$percentage=0){
        $new_price =$original_price - ($original_price * ($percentage/100));
        return $new_price;
    }
}

if
(!function_exists('calculated_subtotal')){
    function calculated_subtotal($price,$quantity,$discount){
        if($discount){
            $final_price = $price - ($price * ($discount->percentage/100));
        }else{
            $final_price = $price*$quantity;
        }
        return $final_price;
    }
}

if(!function_exists('check_new_notifications')){
    function check_new_notifications(){
        $result = false;
        $notifications = Notification::get();
        foreach($notifications as $notification){
            if($notification->status == "unread"){
                $result = true;
            }
        }
        return $result;
    }
}

if(!function_exists('total')){
    function total($collection){
        $total = 0;
        foreach($collection as $c){
            $c->subtotal = 0;
            if($c->product->discount){
                $c->subtotal = calculated_subtotal($c->product->price,$c->quantity,$c->product->discount);
            }else{
                $c->subtotal = calculated_subtotal($c->product->price,$c->quantity,$c->product->discount);
            }
            $total += $c->subtotal;
        }
        return $total;
    }
}

if(!function_exists('send_message_alert')){
    function send_message_alert($model){
        $message = 'A new message has entered to your mail.';
        Notification::create([
            'notifiable_id' => 1,
            'notifiable_type'=>"Contact",
            'title' => $message,
            'description' => "Lorem ipsum dolor imet"
        ]);
    }
}

if(!function_exists('add_to_cart')){
    // add to cart
    function add_to_cart($id, $quantity = 1){
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
