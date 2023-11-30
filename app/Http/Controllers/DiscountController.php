<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Product;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function add(Request $request)
    {
        $data = [
            'percentage' => $request->percentage,
            'product_id' => $request->productId,
        ];
        Discount::create($data);
        $discount = Discount::orderBy('created_at', 'desc')->first();
        return response()->json($discount, 200);
    }

    public function update(Request $request)
    {
        Discount::where('id', $request->id)->update([
            'percentage' => $request->percentage
        ]);
        $discount = Discount::where('id', $request->id)->first();
        return response()->json($discount, 200);
    }

    public function bulkAdd(Request $request)
    {
        $checkboxIds = explode(",", $request->input('checkboxIds'));
        $discountIds = [];

        foreach ($checkboxIds as $id) {
            $discount = Discount::firstOrCreate([
                'product_id' => $id,
                'percentage' => $request->percentage,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
            ]);

            $discountIds[] = $discount->id;
        }

        $event = Event::find($request->event);
        $event->products()->attach($checkboxIds);
        $event->discounts()->attach($discountIds);

        // Attach discounts to the event through the product_discounts pivot table
        return back();
    }
}
