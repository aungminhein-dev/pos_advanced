<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Models\DeliveryLocation;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function list()
    {
        $deliveryAreas = DeliveryLocation::all();
        $cartItems = Cart::where('user_id', Auth::user()->id)->with(['product', 'user'])->get();
        return view('user.cart', compact('cartItems', 'deliveryAreas'));
    }

    public function update(Request $request)
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
        return response()->json(['message' => 'Cart updated successfully']);
    }

    public function clearCart(Request $request)
    {
        $items = Cart::where('user_id', Auth::user()->id)->with('product')->get();
        
        foreach($items as $item){
            $instock = Product::where('id',$item->product->id)->first()->quantity;
            Product::where('id',$item->product->id)->update([
                'quantity' => $instock + $item->quantity
            ]);
        }
        $items = Cart::where('user_id',Auth::user()->id)->delete();
        return response()->json(['message' => 'Cart cleared successfully'],200);
    }

    public function checkoutPage()
    {
        $deliveryAreas = DeliveryLocation::all();
        $cartItems = Cart::where('user_id', Auth::user()->id)->with(['product', 'user'])->get();
        return view('user.checkout', compact('deliveryAreas', 'cartItems'));
    }

    public function checkout(Request $request)
    {
        $orderData = $this->requestOrderData($request);
        $orderDetailsDatas = $request->products;
        $createdOrderData = Order::create($orderData);
        $orderId = $createdOrderData->id;

        foreach ($orderDetailsDatas as $orderDetailsData) {
            OrderDetail::create($this->requestOrderDetailsData($orderDetailsData, $orderId));
        }
        $this->notifyOrderToAdmins($orderId);
        Cart::where('user_id', Auth::user()->id)->delete();
        toastr()->success('Your order has beesn placed!', 'Success');
        // Show success Toastr notification
        return redirect()->route('home');
    }


    private function requestOrderData($request)
    {
        return [
            'user_id' => Auth::user()->id,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'payment_account_name' => $request->paymentAccountNumber,
            'payment_process_number' => $request->paymentProcessNumber,
            'location_link' => $request->locationLink,
            'delivery_price' => $request->deliveryPrice,
            'total' => $request->total,
            'total_with_delivery_price' => $request->totalWithDeliveryPrice
        ];
    }

    private function requestOrderDetailsData($orderDetailsData, $orderId)
    {
        return [
            'order_id' => $orderId,
            'quantity' => $orderDetailsData['quantity'],
            'subtotal' => $orderDetailsData['subtotal'],
            'product_id' => $orderDetailsData['id'],
        ];
    }

    private function notifyOrderToAdmins($orderId)
    {
        return Order::find($orderId)->notifications()->create([
            'title' => "A new order has arrived!",
            'description' => 'Lorem'
        ]);
    }

    public function addToCart(Request $request)
    {
        $product = Product::where('id', $request->productId)->first();
        add_to_cart($product->id,$quantity = $request->quantity);
        return response()->json(['message' => "Added to cart!"], 200);
    }
}
