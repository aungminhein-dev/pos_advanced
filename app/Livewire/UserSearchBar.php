<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class UserSearchBar extends Component
{
    public $searchKey;
    public function render()
    {

    $products = collect();
        if(strlen($this->searchKey) > 2){
            $products = Product::select('name','slug','id')->where('name','like','%'.$this->searchKey.'%')->get();
        }
        return view('livewire.user-search-bar',compact('products'));
    }
}
