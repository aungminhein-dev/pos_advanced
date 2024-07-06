<?php
namespace App\Services;

use App\Mail\Invoice;
use App\Models\Order;
use App\Mail\InvoiceMail;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Mail;

class OrderService
{
    public function sendOrderInvoiveEmail($order)
    {
        $orderDetails = OrderDetail::whereBelongsTo($order)->with('product')->get();
        $order = $order;
        Mail::to($order->email)->send(new Invoice($order,$orderDetails));
    }

    public function acceptOrder($orderId)
    {
        Order::where('id',$orderId)->update([
            'status' => 1
        ]);
        $order = Order::where('id',$orderId)->first();
        $this->sendOrderInvoiveEmail($order);
    }

    public function getOrder($userId)
    {
        return Order::where('user_id',$userId)->get();
    }

    public function getOrderDetails($orderId)
    {
        return Order::where('id',$orderId)->with('products','orderDetails.product','orderDetails.product.discount','orderDetails.product.images')->first();
    }
}
