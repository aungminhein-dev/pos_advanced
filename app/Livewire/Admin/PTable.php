<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class PTable extends Component
{
    use WithPagination;
    public $key;
    public function render()
    {
        $products = collect();
        if(strlen($this->key > 2)){
            $products = Product::with(['subCategory', 'sizes', 'colours', 'images','tags','discount'])->where('name','like','%'.$this->key.'%')->paginate(2);
        }else{
            $products = Product::with(['subCategory', 'sizes', 'colours', 'images','discount'])->paginate(5);
        }
        return view('livewire.admin.p-table',compact('products'));
    }
}
