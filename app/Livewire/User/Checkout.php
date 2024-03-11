<?php

namespace App\Livewire\User;

use App\Models\Cart;
use App\Models\Order;
use Livewire\Component;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Checkout extends Component
{
    public function render()
    {
        return view('livewire.user.checkout');
    }
}
