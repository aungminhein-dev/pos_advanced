<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function list()
    {
        $events = Event::with([
            'image',
            'products' => function($query){
                $query->with('subCategory');
            },
            'discounts' => function ($query) {
                $query->select( 'percentage', 'event_id')
                    ->orderBy('percentage', 'desc')
                    ->limit(1);
            },
        ])->get();

        // dd($events->toArray());
        return view('admin.event.list', compact('events'));
    }

    public function addPage()
    {
        return view('admin.event.add-page');
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg,webp',
            'startDate' => 'required',
            'endDate' => 'required',
            'description' => 'required'
        ]);
        $data = [
            'name' => $request->name,
            'start_date' => $request->startDate,
            'end_date' => $request->endDate,
            'description' => $request->description,
            'slug' => strtolower(str_replace(' ', '-', $request->name))
        ];
        $event = Event::create($data);
        if ($request->has('image')) {
            $filePath = 'storage/event/' . uniqid() . $request->file('image')->getClientOriginalName();
            $filePathToBeSaved = str_replace('storage/', '', $filePath);
            $request->image->storeAs('public', $filePathToBeSaved);
            $event->image()->create([
                'image_path' => $filePath
            ]);
        }

        return redirect()->route('event.list')->with('createSuccessMessage', 'A new event is created!');
    }

    public function addItems($slug)
    {
        $products = Product::orderBy('created_at', 'desc')
            ->with('images', 'discount', 'events')
            ->get();

        $event = Event::where('slug', $slug)->first();

        $event_products = Product::whereHas('events', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->with(['events', 'images', 'discount'])->get();

        // Extract the IDs of products in $event_products
        $eventProductIds = $event_products->pluck('id');

        // Remove products that are in both $products and $event_products
        $filteredProducts = $products->reject(function ($product) use ($eventProductIds) {
            return $eventProductIds->contains($product->id);
        });

        // dd($filteredProducts->toArray());

        $categories = Category::select('name', 'id')->get();
        return view('admin.event.add-items', compact('products', 'event','event_products', 'categories','filteredProducts'));
    }
}
