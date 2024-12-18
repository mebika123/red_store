<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->paginate(10);
        return view('admin.products.index', compact('products'));
    }
    public function create()
    {   
        $categories = Category::select('id','name')->orderBy('name')->get();
        $brands = Brand::select('id','name')->orderBy('name')->get();
        return view('admin.products.create',compact('categories','brands'));
    }
    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'slug'=>'required|unique:products,slug',
            'short_description'=>'required',
            'description'=>'required',
            'regular_price'=>'required|numeric',
            'sale_price'=>'required|numeric',
            'SKU'=>'required',
            'stock_status'=>'required',
            'featured'=>'required',
            'quantity'=>'required|numeric',
            'image'=>'required|mimes:png,jpg,jpeg|max:2048',
            'category_id'=>'required',
            'brand_id'=>'required',
        ]);
        $product = new Product();
        $product->name=$request->name;
        $product->slug=$request->slug;
        $product->short_description=$request->short_description;
        $product->description=$request->description;
        $product->regular_price=$request->regular_price;
        $product->sale_price=$request->sale_price;
        $product->SKU=$request->SKU;
        $product->stock_status=$request->stock_status;
        $product->featured=$request->featured;
        $product->quantity=$request->quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;

        $current_timestamp = Carbon::now()->timestamp;
        $thumbnailDestinationPath = public_path('uploads/products/thumbnails');
        $destinationPath = public_path('uploads/products');

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = $current_timestamp.'.'. $image->extension();
            $this->GeneraterThumbailsImage($image,$imageName,$thumbnailDestinationPath,104,104);
            $this->GeneraterThumbailsImage($image,$imageName,$destinationPath,540,689);
            $product->image = $imageName;
        }
        $gallery_arr = array();
        $gallery_images ="";
        $counter = 1;
        if($request->hasFile('images')){
          $allowedfileExtion = ['jpg','png','jpeg'];
          $files = $request->file('images');
          foreach($files as $file){
            $gextension = $file->getClientOriginalExtension();
            $gcheck = in_array($gextension,$allowedfileExtion);
            if($gcheck){
                $gfileName = $current_timestamp . "-" . $counter . "." . $gextension;
                $this->GeneraterThumbailsImage($file,$gfileName,$thumbnailDestinationPath,104,104);
                $this->GeneraterThumbailsImage($file,$gfileName,$destinationPath,540,689);
    
                array_push($gallery_arr,$gfileName);
                $counter = $counter +1;
            }
          }
          $gallery_images = implode(',',$gallery_arr);
        }
        $product->images = $gallery_images;
        $product->save();
        return redirect()->route('admin.products')->with('status','Product has been added successfully!');
    }

    public function edit($id){
        $product = Product::findOrFail($id);
        $categories = Category::select('id','name')->orderBy('name')->get();
        $brands = Brand::select('id','name')->orderBy('name')->get();
        return view('admin.products.edit',compact('product','categories','brands'));
    }

    public function update(Request $request){
        $request->validate([
            'name'=>'required',
            'slug'=>'required|unique:products,slug,'.$request->id,
            'short_description'=>'required',
            'description'=>'required',
            'regular_price'=>'required|numeric',
            'sale_price'=>'required|numeric',
            'SKU'=>'required',
            'stock_status'=>'required',
            'featured'=>'required',
            'quantity'=>'required|numeric',
            'image'=>'mimes:png,jpg,jpeg|max:2048',
            'category_id'=>'required',
            'brand_id'=>'required',
        ]); 
        $product = Product::find($request->id);
        $product->name=$request->name;
        $product->slug=$request->slug;
        $product->short_description=$request->short_description;
        $product->description=$request->description;
        $product->regular_price=$request->regular_price;
        $product->sale_price=$request->sale_price;
        $product->SKU=$request->SKU;
        $product->stock_status=$request->stock_status;
        $product->featured=$request->featured;
        $product->quantity=$request->quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;

        $current_timestamp = Carbon::now()->timestamp;
        $thumbnailDestinationPath = public_path('uploads/products/thumbnails');
        $destinationPath = public_path('uploads/products');
        if($request->hasFile('image')){
            if(File::exists(public_path('uploads/products').'/'.$product->image)){
                File::delete(public_path('uploads/products').'/'.$product->image);
            }
            if(File::exists(public_path('uploads/products/thumbnails').'/'.$product->image)){
                File::delete(public_path('uploads/products/thumbnails').'/'.$product->image);
            }
            $image = $request->file('image');
            $imageName = $current_timestamp.'.'. $image->extension();
            $this->GeneraterThumbailsImage($image,$imageName,$thumbnailDestinationPath,104,104);
            $this->GeneraterThumbailsImage($image,$imageName,$destinationPath,540,689);
            $product->image = $imageName;
        }

        $gallery_arr = array();
        $gallery_images ="";
        $counter = 1;
        if($request->hasFile('images')){
            foreach( explode(',',$product->images) as $gimg){
                if(File::exists(public_path('uploads/products').'/'.$gimg)){
                    File::delete(public_path('uploads/products').'/'.$gimg);
                }
                if(File::exists(public_path('uploads/products/thumbnails').'/'.$gimg)){
                    File::delete(public_path('uploads/products/thumbnails').'/'.$gimg);
                } 
            }
          $allowedfileExtion = ['jpg','png','jpeg'];
          $files = $request->file('images');
          foreach($files as $file){
            $gextension = $file->getClientOriginalExtension();
            $gcheck = in_array($gextension,$allowedfileExtion);
            if($gcheck){
                $gfileName = $current_timestamp . "-" . $counter . "." . $gextension;
                $this->GeneraterThumbailsImage($file,$gfileName,$thumbnailDestinationPath,104,104);
                $this->GeneraterThumbailsImage($file,$gfileName,$destinationPath,540,689);
    
                array_push($gallery_arr,$gfileName);
                $counter = $counter +1;
            }
          }
          $gallery_images = implode(',',$gallery_arr);
          $product->images = $gallery_images;
        }
        $product->save();
        return redirect()->route('admin.products')->with('status','Product has been updated successfully!');


    }

    public function GeneraterThumbailsImage($image,$imageName,$path,$height=124,$width=124){
        $img = Image::read($image->path());
        $img->cover($height,$width,"top");
        $img->resize($height,$width,function($constraint){
            $constraint->aspectRatio();
        })->save($path.'/'.$imageName);
    }

    public function delete($id){
        $product = Product::find($id);
        if(File::exists(public_path('uploads/products').'/'.$product->image)){
            File::delete(public_path('uploads/products').'/'.$product->image);
        }
        if(File::exists(public_path('uploads/products/thumbnails').'/'.$product->image)){
            File::delete(public_path('uploads/products/thumbnails').'/'.$product->image);
        }
        foreach( explode(',',$product->images) as $gimg){
            if(File::exists(public_path('uploads/products').'/'.$gimg)){
                File::delete(public_path('uploads/products').'/'.$gimg);
            }
            if(File::exists(public_path('uploads/products/thumbnails').'/'.$gimg)){
                File::delete(public_path('uploads/products/thumbnails').'/'.$gimg);
            } 
        }
        $product->delete();
        return redirect()->route('admin.products')->with('status','Product has been deleted successfully!');

    }
}
