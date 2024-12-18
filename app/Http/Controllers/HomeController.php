<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Message;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $categories = Category::orderBy('name','ASC')->get();
        $fproducts = Product::where('featured','1')->get()->take(4);
        $lproducts = Product::orderBy('created_at','ASC')->get()->take(8);

        return view('index',compact('categories','fproducts','lproducts'));
    }
    public function contact(){
        return view('contact');
    }
    public function contact_store(Request $request){
        $request->validate([
            'firstName'=>'required',
            'lastName'=>'required',
            'phone'=>'required|numeric|digits:10',
            'email'=>'required|email',
            'msg'=>'required',
        ]);
        $message = new Message();
        $message->name = $request->firstName.' '. $request->lastName;
        $message->phone = $request->phone;
        $message->email = $request->email;
        $message->message = $request->msg;
        $message->save();
        return redirect()->back()->with('status','Your message has been sent');
    }
}
