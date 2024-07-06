<?php

namespace App\Livewire\User;

use App\Models\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CartDropdown extends Component
{
    public $cartItems;
    public $cartItemCount;

    protected $listeners = ['addedToCart' => 'updateCartItems'];

    public function mount()
    {
        $this->updateCartItems();
    }

    public function updateCartItems()
    {
        $this->cartItems = Cart::where('user_id', Auth::user()->id)->with('product','product.images','product.discount', 'user')->get();
        $this->cartItemCount = $this->cartItems->count();
    }

    public function render()
    {
        return view('livewire.user.cart-dropdown');
    }
}
