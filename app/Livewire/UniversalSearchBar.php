<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\UserRecentSearch;
use Illuminate\Support\Facades\URL;

class UniversalSearchBar extends Component
{
    public $key;
    public $url;

    public function mount()
    {
        $this->url = request()->path();
    }

    public function render()
    {
        $categories = collect();
        $users = collect();
        $products = collect();
        if (strlen($this->key) > 2) {
            $searchKey = $this->key;
            $categories = Category::where('name', 'like', '%' . $searchKey . '%')->withCount('subCategories')->get();
            $users = User::where('name', 'like', '%' . $searchKey . '%')->get();
            $products = Product::where('name', 'like', '%' . $searchKey . '%')->get();
        }

        return view('livewire.universal-search-bar', compact('categories', 'users','products'));
    }
}
