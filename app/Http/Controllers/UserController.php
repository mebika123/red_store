<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        return view('user.index');
    }

    public function users(){
        $users = User::orderBy('id')->paginate(10);
        return view('admin.users.index',compact('users'));
    }
    
    public function create(){
        return view('admin.users.create');
    }

    protected function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect()->route('admin.users')->with('status','users has been created successfully!');
    }

    public function edit($id){
        $user = User::findOrFail($id);
        return view('admin.users.edit',compact('user'));
    }

    public function update(Request $request,$id){
        $request->validate([
            'utype'=>'required|in:ADM,USR',
        ]);
        $user = User::findOrFail($id);
         $user->utype = $request->utype;
        $user->save();

        return redirect()->route('admin.users')->with('status','Users has been updated successfully!');
    }

    public function delete($id){
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users')->with('status','Users has been deleted successfully!');
    }

    public function user_info(){
        $admUser = User::find(Auth::user()->id);
        return view('admin.setting',compact('admUser'));
    }

    public function update_password(Request $request){
        $request->validate([
            'current_password'=>'required',
            'new_password'=>'required|min:8|confirmed',
        ]);
        $user = Auth::user();
        if(!Hash::check($request->current_password, $user->password)){
            return back()->withErrors(['current_password'=>'Current password is incorrect.']);
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        return redirect()->back()->with('success','Your password has been succesfully change');
    }

    public function user_view(){
        $user = User::find(Auth::user()->id);
        return view('user.user-view',compact('user'));
    }
    public function order_view(){
        $orders = Order::where('user_id',Auth::user()->id)->paginate(10);
        return view('user.orders-view',compact('orders'));
    }
}
