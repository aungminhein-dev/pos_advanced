<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\SubCategory;
use Livewire\Attributes\Rule;

class SubCategoryForm extends Component
{
    public $id = '';

    #[Rule('required')]
    public $subCategoryName = '';

    public $category;


    public function add()
    {
        $this->validate();
        SubCategory::create([
            'name' => $this->subCategoryName,
            'category_id' => $this->id,
            'slug' => strtolower(str_replace(' ','-',$this->subCategoryName))
        ]);
        $this->reset('subCategoryName');
    }

    public function delete($id)
    {
        SubCategory::where('id',$id)->delete();
    }

    public function render()
    {
        return view('livewire.sub-category-form');
    }
}
