<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Category;
use App\Models\ActivityLog;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function list()
    {
        $categories = Category::withCount('subCategories', 'products')->with('image')->get();
        return view('admin.category.list', compact('categories'));
    }

    public function addPage()
    {
        $subCategories = SubCategory::get();
        return view('admin.category.add-page', compact('subCategories'));
    }

    public function add(Request $request)
    {
        $this->validateCategory($request, true);
        $data = $this->getCategoryData($request);
        $image = $this->uploadImage($request, $data);
        $category = Category::create($data);
        $this->createNotification($category->id, 'create');
        if ($image) {
            $category->image()->create([
                'image_path' => $image
            ]);
        }
        $category->tag()->create([
            'tag' => strtolower('#' . str_replace('', '-', $category->name))
        ]);

        $this->logTo($category->id,'create',Auth::user()->name);

        return redirect()->route('category.list')->with('createSuccessMessage', 'A new category is created.');
    }

    public function delete(Request $request)
    {
        $category = Category::with('image')->find($request->category_id);
        // dd($category->toArray());
        $this->deleteCategoryImage($category);
        $category->delete();
        return back()->with('deleteSuccessMessage', 'Category deleted successfully.');
    }

    public function edit($slug)
    {
        $subCategories = SubCategory::get();
        $category = Category::where('slug', $slug)->first();
        return view('admin.category.edit', compact('subCategories', 'category'));
    }

    public function update(Request $request)
    {
        $this->validateCategory($request);
        $data = $this->getCategoryData($request);
        $this->uploadImage($request, $data);
        Category::where('id', $request->categoryId)->update($data);
        return redirect()->route('category.list')->with('updateSuccessMessage', 'A category is updated.');
    }

    public function detail($slug)
    {
        $category = Category::where('slug', $slug)->with('subCategories', 'image', 'tag')->first();
        return view('admin.category.detail', compact('category'));
    }

    private function validateCategory($request, $imageRequired = false)
    {
        $rules = [
            'name' => 'required|unique:categories,name,' . $request->categoryId,
            'description' => 'required',
        ];

        if ($imageRequired) {
            $rules['image'] = 'required|mimes:png,jpg,webp,gif,jpeg';
        } else {
            $rules['image'] = 'sometimes|mimes:png,jpg,webp,gif,jpeg';
        }

        $request->validate($rules);
    }

    private function getCategoryData($request)
    {
        return [
            'name' => $request->name,
            'description' => $request->description,
            'slug' => strtolower(str_replace(' ', '-', $request->name))
        ];
    }
    private function uploadImage($request, &$data)
    {
        if ($request->hasFile('image')) {
            $filePath = 'storage/category/' . uniqid() . $request->file('image')->getClientOriginalName();
            $filePathToBeSaved = str_replace('storage/', '', $filePath);
            $request->image->storeAs('public', $filePathToBeSaved);
            return $filePath;
        }
        return null;
    }

    private function deleteCategoryImage($category)
    {
        if (File::exists($category->image->image_path)) {
            File::delete($category->image->image_path);
        }
    }

    private function createNotification($categoryId, $action)
    {
        $category = Category::find($categoryId);
        $message = ($category->count() === 1) ? $category->name . " is added to categories." : $category->name . " are added to categories.";
        $category->notifications()->create([
            'title' => $message,
            'description' => "Lorem ipsum dolor imet"
        ]);
    }

    private function logTo($categoryId, $action, $userName)
    {
        $category = Category::find($categoryId);
        $message = $category->name . "is ". $action."d" . " to categories by " . $userName . " .";
        $category->activityLog()->create([
            'title' => $message,
            'user_id' => Auth::user()->id
        ]);
    }
}
