<?php

use App\Models\Cart;
use App\Models\Product;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

if (!function_exists('discounted_price')) {
    function discounted_price($original_price, $percentage = 0)
    {
        $new_price = $original_price - ($original_price * ($percentage / 100));
        return $new_price;
    }
}

if (!function_exists('price_of')) {
    function price_of($product)
    {
        $original_price = $product->price;
        $discount = collect();
        $percentage = 0;
        if ($product->discount) {
            $discount = $product->discount;
            $percentage = $discount->percentage;
        }
        $new_price = $original_price - ($original_price * ($percentage / 100));
        return $new_price;
    }
}


if (!function_exists('calculated_subtotal')) {
    function calculated_subtotal($price, $quantity, $discount)
    {
        if ($discount) {
            $discounted_price = $price - ($price * ($discount->percentage / 100));
            $final_price =  $discounted_price * $quantity;
        } else {
            $final_price = $price * $quantity;
        }
        return $final_price;
    }
}

if (!function_exists('check_new_notifications')) {
    function check_new_notifications()
    {
        $result = false;
        $notifications = Notification::get();
        foreach ($notifications as $notification) {
            if ($notification->status == "unread") {
                $result = true;
            }
        }
        return $result;
    }
}

if (!function_exists('total')) {
    function total($collection)
    {
        $total = 0;
        foreach ($collection as $c) {
            $c->subtotal = 0;
            $c->subtotal = calculated_subtotal($c->product->price, $c->quantity, $c->product->discount);
            $total += $c->subtotal;
        }
        return $total;
    }
}

if (!function_exists('send_message_alert')) {
    function send_message_alert($model)
    {
        $message = 'A new message has entered to your mail.';
        Notification::create([
            'notifiable_id' => 1,
            'notifiable_type' => "Contact",
            'title' => $message,
            'description' => "Lorem ipsum dolor imet"
        ]);
    }
}

if (!function_exists('increase_view_count')) {
    function increase_view_count($id)
    {
        Product::where('id', $id)->increment('view_count', 1);
    }
}

if (!function_exists('star_rating')) {
    function star_rating_of($product)
    {
        if ($product->ratings) {
            $stars = round($product->ratings->avg('star_count'));
            return $stars;
        }
        return 0;
    }
}
if (!function_exists('number_rating')) {
    function number_rating_of($product)
    {
        if ($product->ratings) {
            $stars = round($product->ratings->avg('star_count'));
            $rating_number = ($stars / 5) * 10;
            return $rating_number;
        }
        return 0;
    }
}

// if(!function_exists('standard_notation_of')){
//     function standard_notation_of(int $digit)
//     {
//         if($digit > 999){
//             str_split($digit,3);
//         }
//     }
// }
