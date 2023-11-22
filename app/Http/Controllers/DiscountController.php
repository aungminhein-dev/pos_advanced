<?php

namespace App\Http\Controllers;

use App\Models\ProductDiscount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function add(Request $request)
    {
        $data = [
            'percentage' => $request->percentage,
            'product_id' => $request->productId,
        ];
        ProductDiscount::create($data);
        return response()->json(['message','Product is discounted!'],200);
    }

    public function update(Request $request)
    {
ProductDiscount::where('id',$request->id)->update([
            'percentage' => $request->percentage
        ]);
        $discount = ProductDiscount::where('id',$request->id)->first();
        return response()->json($discount,200);

    }
}
