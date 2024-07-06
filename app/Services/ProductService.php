<?php

namespace App\Services;

use App\Models\Size;
use App\Models\Colour;
use App\Models\Product;
use App\Models\Discount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class ProductService {


    public function productListWithPagination($key=null,$itemPerPage=10)
    {
       return Product::with('subCategory','category', 'sizes', 'colours', 'images','discount','brand','ratings')->withCount('comments')->where('name','like','%'.$key.'%')->paginate($itemPerPage);
    }

    public function productList($key=null)
    {
       return Product::with('subCategory','category', 'sizes', 'colours', 'images','discount','brand','ratings')->withCount('comments')->where('name','like','%'.$key.'%')->get();
    }

    public function productDetails($slug)
    {
        $product = Product::query()->detailsBySlug($slug);
        increase_view_count($product->id);
        return $product;
    }

    public function addProduct($request)
    {
        $this->validateProductInputs($request, true);
        $product = Product::create($this->getInputProductData($request));
        $this->createProductAssets($request, $product->id, 'create');
        $this->uploadImages($request->images, $product);
    }

    public function updateProduct($request)
    {
        $product = Product::find($request->productId);
        $this->validateProductInputs($request);
        $data = $this->getInputProductData($request);
        $product->update($data);
        $this->createProductAssets($request, $product->id, 'update');
        $this->uploadImages($request->images, $product);
    }



    public function deleteProduct($request)
    {
        $product = Product::with('images')->find($request->id);
        $this->deleteProductImages($product->images);
        $product->delete();
        $this->logTo($product->id,'delete',Auth::user()->name);
    }
    private function deleteProductImages($images)
    {
        foreach ($images as $image) {
            $this->deleteImagePrivate($image->image_path);
        }
    }

    private function deleteImagePrivate($image)
    {
        if (File::exists($image)) {
            File::delete($image);
        }
    }




    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    private function validateProductInputs($request, $imageIsRequired = false)
    {
        $rules = $request->validate([
            'name' => 'required|unique:products,name,' . $request->productId,
            'description' => 'required',
            'price' => 'required',
            'subCategories' => 'required',
            'quantity' => 'required',
            'purchasingPrice'=> 'required',
            'sellingPrice' => 'required',
            // 'brand' => 'required',
            // 'images.*' => $imageIsRequired ? 'required|mimes:png,jpg,webp,gif,jpeg' : 'sometimes|mimes:png,jpg,webp,gif,jpeg',
        ]);
    }

    private function getInputProductData($request)
    {
        return [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'sub_category_id' => $request->subCategories,
            'quantity' => $request->quantity,
            'slug' => strtolower(str_replace(' ', '-', $request->name)),
            'brand_id' => $request->brand,
            'purchasing_price'=> $request->purchasingPrice,
            'selling_price' => $request->sellingPrice
        ];
    }

    private function createProductAssets($request, $createdProductId, $action)
    {
        $this->createSizes($request->sizes, $createdProductId);
        $this->createColours($request->colours, $createdProductId);
        $this->createTags($request->tags, $createdProductId);
        $this->createDiscount($request, $createdProductId, $action);
        $this->createNotification($request,$createdProductId,$action);
        $this->logTo($createdProductId,$action,Auth::user()->name);

    }

    private function uploadImage($image, $productId)
    {
        $filePath = 'storage/product/' . uniqid() . $image->getClientOriginalName();
        $filePathToBeSaved = str_replace('storage/', '', $filePath);
        $image->storeAs('public', $filePathToBeSaved);
        return $filePath;
    }

    private function uploadImages($images, $product)
    {
        if ($images) {
            foreach ($images as $image) {
                $imagePath = $this->uploadImage($image, $product->id);
                $product->images()->create(['image_path' => $imagePath]);
            }
        }
    }

    private function createSizes($sizes, $productId)
    {
        if ($sizes) {
            foreach ($sizes as $size) {
                Size::create(['size' => $size, 'product_id' => $productId]);
            }
        }
    }

    private function createColours($colours, $productId)
    {
        if ($colours) {
            foreach ($colours as $colour) {
                Colour::create(['colour' => $colour, 'product_id' => $productId]);
            }
        }
    }

    private function createTags($newTags, $productId)
    {
        if ($newTags) {
            $product = Product::find($productId);
            $uniqueTags = collect($newTags)->unique();
            foreach ($uniqueTags as $tagName) {
                $product->tags()->firstOrCreate(['tag' => $tagName]);
            }
        }
    }

    private function createDisCount($request, $productId, $action)
    {
        if ($request->discount && $action == "create") {
            Discount::create([
                'percentage' => $request->discount,
                'product_id' => $productId,
                'start_date' => $request->startDate,
                'end_date' => $request->endDate
            ]);
        }

        if ($request->discount && $action = "update") {
            Discount::where('id', $productId)->update([
                'percentage' => $request->discount,
                'start_date' => $request->startDate,
                'end_date' => $request->endDate
            ]);
        }
    }

    private function createNotification($request, $productId, $action)
    {
        $product = Product::find($productId);
        if($action =="create"){
            $message = ($product->count() === 1) ? $product->name . " is added to products." : $product->name . " are added to products.";
        }else{
            $message = ($product->count() === 1) ? $product->name . " is updated." : $product->name . " are updated.";
        }
        $product->notifications()->create([
            'title' => $message,
            'description' => "Lorem ipsum dolor imet"
        ]);
    }

    private function logTo($productId,$action,$userName)
    {
        $product = Product::find($productId);
        $message = $product->first()->name . " is ". $action."d" . " to products
         by " . $userName . " .";
        $product->activityLog()->create([
            'title' => $message,
            'user_id' => Auth::user()->id
        ]);
    }
}

