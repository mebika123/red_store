<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request){
        $order = $request->query('order');
        $o_column = '';
        $o_order="";
        $f_category=$request->query('hdncategory');
        $categories = Category::orderBy('name')->get();
        switch ($order) {
            case 1:
                $o_column = 'created_at';
                $o_order = 'DESC';
                break;
            case 2:
                $o_column = 'created_at';
                $o_order = 'ASC';
                break;
            case 3:
                $o_column = 'sale_price';
                $o_order = 'ASC';
                break;
            case 4:
                $o_column = 'sale_price';
                $o_order = 'DESC';
                break;
            default:
                $o_column = 'id';
                $o_order = 'DESC';
                break;
        }
        $products = Product::where(function($query) use($f_category) {
            $query->whereIn('category_id', explode(',', $f_category))->orWhereRaw("'". $f_category ."'=''");
        })
        ->orderBy($o_column, $o_order)->paginate(12);
        return view('shop',compact('products','categories','order','f_category'));
    }
    public function product_details($product_slug){
        $product = Product::where('slug',$product_slug)->first();
        $rproducts = Product::where('slug', '<>', $product_slug)->get()->take(5);
        return view('details',compact('product','rproducts'));
    }

}
