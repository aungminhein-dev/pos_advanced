<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Notification;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function markAsAllRead()
    {
        // dd('hello');
        $notifications = Notification::get();
        foreach ($notifications as $notification) {
            $notification->update([
                'status' => 'read'
            ]);
        }
        return response()->json(['message' => 'Success'], 200);
    }

    public function notifyAdmins()
    {
        $order = Order::where('status', 0)->first();

        ob_end_flush(); // Turn off output buffering
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
        header('Connection: keep-alive');
        if ($order) {
            $order->update([
                'status' => 1
            ]);
            $newOrders = Order::where('status',1)->count();
            $eventData = [
                "message" => "An order has arrived",
                "newOrderCount" => $newOrders
            ];
            echo "data: " . json_encode($eventData) . " \n\n";
        } else {
            echo "\n\n";
        }
        flush();
    }
}
