<?php

namespace App\Http\Controllers;

use Pusher\Pusher;
use App\Models\Cart;
use App\Models\Sale;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use App\Events\OrderCreated;
use Illuminate\Http\Request;
use App\Services\CartService;
use App\Services\OrderService;
use App\Models\DeliveryLocation;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function list()
    {
        $deliveryAreas = DeliveryLocation::all();
        $cartItems = $this->cartService->cartList();
        return view('user.cart', compact('cartItems', 'deliveryAreas'));
    }

    public function update(Request $request)
    {
        $this->cartService->updateCart($request);
        return response()->json(['message' => 'Cart updated successfully']);
    }

    public function clearCart()
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
        $cartItems = Cart::where('user_id', Auth::user()->id)->with(['product','product.images','product.discount', 'user'])->get();
        return view('user.checkout', compact('deliveryAreas', 'cartItems'));
    }

    public function checkout(Request $request,OrderService $orderService)
    {
        $latestOrder = Order::latest('created_at')->first();;
        if($latestOrder){
            $orderCode = "#SNT".$latestOrder->created_at->format('jFY').$latestOrder->id +1;
        }
        $orderCode = "#SNT".$latestOrder->created_at->format('jFY').+1;
        // dd($orderCode);

        $orderData = $this->requestOrderData($request,$orderCode);
        $orderDetailsDatas = $request->products;
        $createdOrderData = Order::create($orderData);
        $orderId = $createdOrderData->id;
        foreach ($orderDetailsDatas as $orderDetailsData) {
            OrderDetail::create($this->requestOrderDetailsData($orderDetailsData, $orderId));
        }

        $this->notifyOrderToAdmins($orderId);
        Cart::where('user_id', Auth::user()->id)->delete();
        toastr()->success('Your order has been placed!', 'Success');
        return redirect()->route('home');
    }


    private function requestOrderData($request,$orderCode)
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
            'order_code' => $orderCode,
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
        $message = "An order has arrived!";
        $data = [
            'title' => $message
        ];
        event(new OrderCreated($data));
        return Order::find($orderId)->notifications()->create([
            'title' => $message,
            'description' => 'Lorem'
        ]);
    }

    public function addToCart(Request $request)
    {
        $product = Product::where('id', $request->productId)->first();
        $this->cartService->addToCart($product->id,$request->quantity);
        return response()->json(['message' => "Added to cart!"], 200);
    }
}
