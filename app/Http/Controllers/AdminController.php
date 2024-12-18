<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $orders = Order::orderBy('Created_at','DESC')->get()->take(5);
        $dashboardDatas = [
            'TotalAmount' => Order::sum('amount'),
            'TotalOrderedAmount' => Order::where('status', 'PENDING')->sum('amount'),
            'TotalDeliveredAmount' => Order::where('status', 'COMPLETED')->sum('amount'),
            'TotalCancelledAmount' => Order::where('status', 'CANCELLED')->sum('amount'),
            'Total' => Order::count(),
            'TotalOrdered' => Order::where('status', 'PENDING')->count(),
            'TotalDelivered' => Order::where('status', 'COMPLETED')->count(),
            'TotalCancelled' => Order::where('status', 'CANCELLED')->count(),
        ];
        return view('admin.index',compact('orders','dashboardDatas'));
    }
}
