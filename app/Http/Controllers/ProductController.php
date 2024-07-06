<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Brand;
use App\Models\Image;
use App\Models\Colour;
use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Services\ProductService;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

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
       $this->productService->addProduct($request);
        return redirect()->route('product.list')->with('created', 'A new product is created.');
    }

    public function detail($slug)
    {
        $product =$this->productService->productDetails($slug);
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
        $this->productService->updateProduct($request);
        return redirect()->route('product.list')->with('updated', 'A product is updated.');
    }

    public function delete(Request $request)
    {
       $this->productService->deleteProduct($request);
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

}
