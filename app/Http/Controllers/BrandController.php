<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    //list
    public function list()
    {
        $brands = Brand::get();
        return view('admin.brand.list',compact('brands'));
    }

    public function addPage()
    {
        return view('admin.brand.add-page');
    }

    // add
    public function add(Request $request)
    {
        $data = [
            'name' => $request->brand,
        ];
        if ($request->hasFile('image')) {
            $filePath = 'storage/brand/' . uniqid() . $request->file('image')->getClientOriginalName();
            $filePathToBeSaved = str_replace('storage/', '', $filePath);
            $request->image->storeAs('public', $filePathToBeSaved);
            $data['image'] = $filePath;
        }
        Brand::create($data);
        return redirect()->route('brand.list')->with('addMessage','A New Brand Added.');
    }

    // edit
    public function edit($id)
    {
        $brand = Brand::where('id',$id)->first();
        return view('admin.brand.edit',compact('brand'));
    }

    public function update(Request $request)
    {
        $data = [
            'name' => $request->brand,
        ];
        if ($request->hasFile('image')) {
            $filePath = 'storage/brand/' . uniqid() . $request->file('image')->getClientOriginalName();
            $filePathToBeSaved = str_replace('storage/', '', $filePath);
            $request->image->storeAs('public', $filePathToBeSaved);
            $data['image'] = $filePath;
        }
        Brand::where('id',$request->brandId)->update($data);
        return redirect()->route('brand.list')->with('updateMessage','A New Brand Update.');
    }

}
