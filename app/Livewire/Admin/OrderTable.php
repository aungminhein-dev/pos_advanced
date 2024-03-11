<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class OrderTable extends Component
{
    use WithPagination;
    public $key;
    public function render()
    {
        $orders = collect();
        if(strlen($this->key > 2)){
            $orders = Order::with('user')->where('name','like','%'.$this->key.'%')->paginate(2);
        }else{
            $orders = Order::with('user')->paginate(5);
        }
        return view('livewire.admin.order-table',compact('orders'));
    }

}
