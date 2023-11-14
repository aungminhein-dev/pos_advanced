<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductSize;
use App\Models\SubCategory;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\ProductColour;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // use withPagination;
    // product list
    public function list()
    {
        return view('admin.product.list');
    }

    // produt add page
    public function addPage()
    {
        $sub_categories = SubCategory::with('category')->get();
        return view('admin.product.add-page', compact('sub_categories'));
    }


    // product add
    public function add(Request $request)
    {
        $this->validateProductInputs($request);
        $data = $this->getInputProductData($request);
        Product::create($data);

        $createdProductId = Product::orderBy('created_at', 'desc')->select('id')->first()->id;
        foreach ($request->images as $image) {
            $this->uploadImage($image, $createdProductId);
        }
        foreach ($request->sizes as $size) {
            ProductSize::create([
                'size' => $size,
                'product_id' => $createdProductId
            ]);
        }
        foreach ($request->colours as $colour) {
            ProductColour::create([
                'colour' => $colour,
                'product_id' => $createdProductId
            ]);
        }
        return redirect()->route('product.list')->with('created', 'A new product is created.');
    }


    // product detail
    public function detail($slug)
    {
        $product = Product::where('slug', $slug)->with(['subCategory', 'sizes', 'colours', 'images'])->first();
        return view('admin.product.detail', compact('product'));
    }


    // product edit
    public function edit($slug)
    {
        $product = Product::where('slug', $slug)->with(['subCategory', 'sizes', 'colours', 'images'])->first();
        $sub_categories = SubCategory::get();
        return view('admin.product.edit', compact('product', 'sub_categories'));
    }

    // update
    public function update(Request $request)
    {
        $this->validateProductInputs($request);
        $data = $this->getInputProductData($request);
        Product::where('id',$request->productId)->update($data);

        $createdProductId = Product::where('id',$request->productId)->select('id')->first()->id;
        foreach ($request->images as $image) {
            $this->uploadImage($image, $createdProductId);
        }
        foreach ($request->sizes as $size) {
            ProductSize::create([
                'size' => $size,
                'product_id' => $createdProductId
            ]);
        }
        foreach ($request->colours as $colour) {
            ProductColour::create([
                'colour' => $colour,
                'product_id' => $createdProductId
            ]);
        }
        return redirect()->route('product.list')->with('updated', 'A new product is updated.');
    }


    // product delete
    public function delete(Request $request)
    {
        $product = Product::where('id',$request->id)->with('images')->first();
        foreach($product->images as $image){
            $this->deleteProductImage($image->image_path);
        }
        $product->delete();
        return redirect()->route('product.list')->with('deleted', 'A new product is deleted.');
    }

    // delete Image
    public function deleteImage(Request $request)
    {
        foreach ($request->imagesId as $id) {
            $image = ProductImage::where('id', $id)->first();
            $imageName = $image->image_path;
            if ($imageName && File::exists($imageName)) {
                File::delete($imageName);
                $message = "Images are deleted";
            } else {
                $message = "Image not found!";
            }
            $image->delete();
        }
        return  response()->json($message, 200);
    }



    // validate data
    private function validateProductInputs($request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'subCategories' => 'required',
            'quantity' => 'required'
        ]);
    }

    // request data
    private function getInputProductData($request)
    {
        return [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'sub_category_id' => $request->subCategories,
            'quantity' => $request->quantity,
            'slug' => strtolower(str_replace(' ', '-', $request->name))
        ];
    }

    private function uploadImage($image, $productId)
    {
        if ($image->isValid()) {
            $filePath = 'storage/product/' . uniqid() . $image->getClientOriginalName();
            $filePathToBeSaved = str_replace('storage/', '', $filePath);
            $image->storeAs('public', $filePathToBeSaved);
            ProductImage::create([
                'image_path' => $filePath,
                'product_id' => $productId
            ]);
        }
    }

    private function deleteProductImage($image)
    {
        if (File::exists($image)) {
            File::delete($image);
        }
    }
}
