<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Image;
use App\Models\Colour;
use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Size;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function list()
    {
        return view('admin.product.list');
    }

    public function addPage()
    {
        $sub_categories = SubCategory::with('category')->get();
        $brands = Brand::get();
        $categories = Category::get();
        return view('admin.product.add-page', compact('sub_categories', 'categories', 'brands'));
    }

    public function add(Request $request)
    {
        $this->validateProductInputs($request, true);
        $product = Product::create($this->getInputProductData($request));
        $this->createProductAssets($request, $product->id, 'create');
        $this->uploadImages($request->images, $product);
        return redirect()->route('product.list')->with('created', 'A new product is created.');
    }

    public function detail($slug)
    {
        $product = Product::where('slug', $slug)->with(['subCategory', 'sizes', 'colours', 'images', 'discount', 'tags'])->first();
        return view('admin.product.detail', compact('product'));
    }

    public function edit($slug)
    {
        $product = Product::where('slug', $slug)->with(['subCategory', 'sizes', 'colours', 'images', 'brand', 'discount', 'tags'])->first();
        $sub_categories = SubCategory::get();
        $brands = Brand::get();
        $categories = Category::get();
        return view('admin.product.edit', compact('product', 'sub_categories', 'brands', 'categories'));
    }

    public function update(Request $request)
    {
        $this->validateProductInputs($request);
        $product = Product::find($request->productId);
        $data = $this->getInputProductData($request);
        $product->update($data);
        $this->createProductAssets($request, $product->id, 'update');
        $this->uploadImages($request->images, $product);
        return redirect()->route('product.list')->with('updated', 'A product is updated.');
    }

    public function delete(Request $request)
    {
        $product = Product::with('images')->find($request->id);
        $this->deleteProductImages($product->images);
        $product->delete();
        return redirect()->route('product.list')->with('deleted', 'A product is deleted.');
    }

    public function deleteImage(Request $request)
    {
        $message = "Image not found!";

        foreach ($request->imagesId as $id) {
            $image = Image::find($id);
            if (File::exists($image->image_path)) {
                File::delete($image->image_path);
                $message = "Images are deleted";
            }
            $image->delete();
        }
        return response()->json($message, 200);
    }

    private function validateProductInputs($request, $imageIsRequired = false)
    {
        $rules = $request->validate([
            'name' => 'required|unique:products,name,' . $request->productId,
            'description' => 'required',
            'price' => 'required',
            'subCategories' => 'required',
            'quantity' => 'required',
            'brand' => 'required',
            'images.*' => $imageIsRequired ? 'required|mimes:png,jpg,webp,gif,jpeg' : 'sometimes|mimes:png,jpg,webp,gif,jpeg',
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
        ];
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

    private function uploadImage($image, $productId)
    {
        $filePath = 'storage/product/' . uniqid() . $image->getClientOriginalName();
        $filePathToBeSaved = str_replace('storage/', '', $filePath);
        $image->storeAs('public', $filePathToBeSaved);
        return $filePath;
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

    private function createProductAssets($request, $createdProductId, $action)
    {
        $this->createSizes($request->sizes, $createdProductId);
        $this->createColours($request->colours, $createdProductId);
        $this->createTags($request->tags, $createdProductId);
        $this->createDiscount($request, $createdProductId, $action);
        $this->createNotification($request,$createdProductId,$action);
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
}
