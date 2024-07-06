<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Category;

class CategoryDropdown extends Component
{
    public function render()
    {
        $categories = Category::with('subCategories')->get();
        return view('livewire.user.category-dropdown',compact('categories'));
    }
}
