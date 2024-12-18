<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(){
        $brands = Brand::orderBy('id','DESC')->paginate(10);
        return view('admin.brands.index',compact('brands'));
    }
    public function create(){
        return view('admin.brands.create');
    }
    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'slug'=>'required|unique:brands,slug',
        ]);
        $brand = New Brand();
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->save();
        return redirect()->route('admin.brands')->with('status','Brand has been added successfully');
    }
    public function edit($id){
        $brand = Brand::findOrFail($id);
        return view('admin.brands.edit',compact('brand'));
    }
    public function update(Request $request){
        $request->validate([
            'name'=>'required',
            'slug'=>'required|unique:brands,slug',
        ]);
        $brand = Brand::findOrFail($request->id);
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->save();
        return redirect()->route('admin.brands')->with('status','Brand has been update successfully');
    }
    public function delete($id){
        $brand = Brand::findOrFail($id);
        $brand->delete();
        return redirect()->route('admin.brands')->with('status','Brand has been deleted successfully');
    }
}
