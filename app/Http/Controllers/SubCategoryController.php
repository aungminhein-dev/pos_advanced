<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:sub_categories,name,'. $request->id
        ]);
        SubCategory::create([
            'name' => $request->name,
            'category_id' => $request->categoryId,
            'slug' => strtolower(str_replace(' ','-',$request->name))
        ]);
        return back()->with('addMessage','A new sub category is added.');
    }

    // delete sub category
    public function delete($id)
    {
        SubCategory::where('id',$id)->delete();
        return back()->with('deleteMessage','A new sub category is deleted.');
    }
}
