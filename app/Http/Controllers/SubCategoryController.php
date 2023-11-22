<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function list(Request $request)
    {
        $categories = SubCategory::where('category_id',$request->categoryId)->select('id','name')->get();
        return response()->json($categories, 200);
    }

}
