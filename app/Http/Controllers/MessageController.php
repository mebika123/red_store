<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(){
        $messages = Message::orderBy('id','ASC')->paginate(10);
        return view('admin.messages.index',compact('messages'));
    }
    public function delete($id){
        $message = Message::findOrFail($id);
        $message->delete();
        return redirect()->back()->with('status','Message has been deleted succesfully');
    }
}
