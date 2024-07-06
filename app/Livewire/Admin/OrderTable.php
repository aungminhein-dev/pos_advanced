<?php

namespace App\Livewire\Admin;

use App\Models\Sale;
use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\OrderService;

class OrderTable extends Component
{
    use WithPagination;
    public $key;
    public function render()
    {
        $orders = collect();
        if(strlen($this->key > 2)){
            $orders = Order::with('user')->where('order_code','like','%'.$this->key.'%')->paginate(5);
        }else{
            $orders = Order::with('user')->paginate(5);
        }
        return view('livewire.admin.order-table',compact('orders'));
    }

    public function accept(OrderService $orderService,$orderId)
    {

        $orderService->acceptOrder($orderId);
        toastr()->success("An order accepted.");
    }

    private function addSaleAmount($amount)
    {
        return Sale::create([
            'sale_amount' => $amount
        ]);
    }

}
