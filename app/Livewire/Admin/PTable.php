<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use App\Services\ProductService;
use Flasher\Laravel\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class PTable extends Component
{
    use WithPagination;
    public $key;
    public function render(ProductService $productService)
    {
        $products = collect();
        if(strlen($this->key > 2)){
            $products = $productService->productListWithPagination($this->key);
        }else{
            $products = Product::with(['subCategory', 'sizes', 'colours', 'images','discount'])->paginate(5);
        }
        return view('livewire.admin.p-table',compact('products'));
    }
}
