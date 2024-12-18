<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CatergoryController extends Controller
{
    public function index(){
        $categories = Category::orderBy('id','DESC')->paginate(10);
        return view('admin.categories.index',compact('categories'));
    }
    public function create(){
        return view('admin.categories.create');
    }
    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'slug'=>'required|unique:categories,slug',
            'image'=>'required|mimes:png,jpg,jpeg|max:2048'
        ]);
        $category = New Category();
        $category->name = $request->name;
        $category->slug = $request->slug;

        $image = $request->image;
        $imageName =Carbon::now()->timestamp.'.'.$image->extension();
        $category->image = $imageName;
        $image->move(public_path('uploads/categories/'),$imageName);

        $category->save();
        return redirect()->route('admin.categories')->with('status','Category has been added successfully');
    }
    public function edit($id){
        $category = Category::findOrFail($id);
        return view('admin.categories.edit',compact('category'));
    }
    public function update(Request $request){
        $request->validate([
            'name'=>'required',
            'slug'=>'required|unique:categories,slug,'.$request->id,
            'image'=>'mimes:png,jpg,jpeg|max:2048'

        ]);
        $category = Category::findOrFail($request->id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        if($request->hasFile('image')){
            if(File::exists(public_path('uploads/categories/').$category->image)){
                File::delete(public_path('uploads/categories/').$category->image);
            }
            $image = $request->file('image');
            $imageName =Carbon::now()->timestamp.'.'.$image->extension();
            $category->image = $imageName;
            $image->move(public_path('uploads/categories/'),$imageName);
        }
        $category->save();
        return redirect()->route('admin.categories')->with('status','Category has been updated successfully');
    }
    public function delete($id){
        $category = Category::findOrFail($id);
        
            if(File::exists(public_path('uploads/categories/').$category->image)){
                File::delete(public_path('uploads/categories/').$category->image);
            }
        $category->delete();
        
        return redirect()->route('admin.categories')->with('status','Category has been deleted successfully');
    }
}
