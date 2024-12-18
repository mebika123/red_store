<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    // public function order_save(Request $request){
    //     $request->validate([
    //         'id' => 'required|exists:products,id',
    //         'email' => 'required|email',
    //         'phone' => 'required|numeric|digits:10',
    //         'address' => 'required',
    //         'quantity' => 'required|numeric|min:1',
    //         'payment' => 'required|in:cod,esewa'
    //     ]);

    //     $product = Product::findOrFail($request->id);

    //     // Check if enough quantity is available
    //     if ($product->quantity < $request->quantity) {
    //         return redirect()->back()->with('error', 'Insufficient stock available.');
    //     }

    //     $user = Auth::user();

    //     $order = new Order();
    //     $order->name = $user->name;
    //     $order->contact = $request->phone;
    //     $order->address = $request->address;
    //     $order->quantity = $request->quantity;
    //     $order->product_id = $request->id;
    //     $order->user_id = $user->id;
    //     $order->status = "PENDING";
    //     $order->payment_status = "PENDING";
    // $order->amount = ($product->sale_price < $product->regular_price ? $product->sale_price : $product->regular_price) * $request->quantity;

    //     try {
    //         $order->save();

    //         // Deduct the quantity from the product's available quantity
    //         $product->quantity -= $request->quantity;
    //         $product->save();

    //         return redirect()->back()->with('success', 'Your order has been placed');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'Failed to place order. Please try again.');
    //     }
    // }


    public function order_save(Request $request)
    {
        $request->validate([
            'phone' => 'required|numeric|digits:10',
            'address' => 'required',
            'quantity' => 'required|numeric',
            'payment' => 'required|in:cod,esewa',
            'id' => 'required|exists:products,id',

        ]);
        $product = Product::findOrFail($request->id);
        $user = Auth::user();
        $order = new Order();

        $order->name = $user->name;
        $order->contact = $request->phone;
        $order->address = $request->address;
        $order->quantity = $request->quantity;
        $order->product_id = $request->id;
        $order->user_id = $user->id;
        $order->status = "PENDING";
        $order->payment_status = "PENDING";
        $order->amount = ($product->sale_price < $product->regular_price ? $product->sale_price : $product->regular_price) * $request->quantity;
        $order->save();

        if ($request->payment == 'esewa') {
            return $this->esewa_payment($order);
        } else {
            return redirect()->back()->with('success', 'Your order has been placed');
        }
    }
    public function esewa_payment($order)
    {
        $msg = 'total_amount=' . $order->amount . ',transaction_uuid=' . $order->id . ',product_code=EPAYTEST';
        $s = base64_encode(hash_hmac('sha256', $msg, '8gBm/:&EnhH.1/q', true));
        $data = [
            'amount' => $order->amount,
            'tax_amount' => 0,
            'total_amount' => $order->amount,
            'transaction_uuid' => $order->id,
            'product_code' => 'EPAYTEST',
            'product_service_charge' => 0,
            'product_delivery_charge' => 0,
            'success_url' => route('user.order.success'),
            'failure_url' => route('shop.product_details', ['slug' => $order->product->slug]),
            'signed_field_names' => 'total_amount,transaction_uuid,product_code',
            'signature' => $s,
        ];

        // Http::asForm()->post('https://rc-epay.esewa.com.np/api/epay/main/v2/form',$data);
        $htmlForm = '<form id="paymentForm" action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">';
        foreach ($data as $key => $value) {
            $htmlForm .= '<input type="hidden" name="' . $key . '" value="' . $value . '">';
        }
        $htmlForm .= '</form>';
        $htmlForm .= '<script>document.getElementById("paymentForm").submit();</script>';

        // Return the HTML to the browser
        return response($htmlForm);
    }

    public function success_response(Request $request)
{
    $data = $request->query('data');
    $decodeData = base64_decode($data);
    
    // Convert decoded data into an associative array (assuming it's JSON-encoded)
    $decodeData = json_decode($decodeData, true);
   

    // Check if the conversion succeeded
    if($decodeData['status']=='COMPLETE'){
        if (!is_array($decodeData) || !isset($decodeData['signed_field_names'])) {
            return redirect()->back()->with('error', 'Invalid data format.');
        }
    
        $arrydata = $decodeData['signed_field_names'];
        $signed = explode(',', $arrydata);

        $msg = '';
        foreach ($signed as $s) {
            if ($s == 'total_amount') {
                $decodeData[$s] = str_replace(",", "", $decodeData[$s]);
            }
            $msg .= $s . '=' . $decodeData[$s].',';
        }
        $msg = rtrim($msg, ',');
        
        $record = base64_encode(hash_hmac('sha256', $msg, '8gBm/:&EnhH.1/q', true));
       
        $order = Order::findOrFail($decodeData['transaction_uuid']);

    
        $product = Product::findOrFail( $order->product_id);
    
        if ($decodeData['signature'] == $record) {
            $order->payment_status = "COMPLETED";
            $order->save();
            // Deduct the quantity from the product's available quantity
                $product->quantity -= $order->quantity;
                $product->save();
    
            return redirect()->route('user.orders')->with('status', 'Your order has been placed.');
        } else {
            return redirect()->route('shop.product_details', ['slug' => $order->product->slug])
                ->with('error', 'Your order cannot be placed.');
        }
    }
  
}


    public function cancle_order($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'CANCELLED';
        $order->payment_status = 'CANCELLED';
        $order->save();
        $product = Product::findOrFail($order->product_id);
        $product->quantity += $order->quantity;
        $product->save();
        return redirect()->back()->with('status', 'Your order has been deleted');
    }
    public function index()
    {
        $orders = Order::orderBy('id')->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }
    public function order_details($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders.details', compact('order'));
    }
    public function update_order_status(Request $request){
        $order = Order::find($request->order_id);
        $order->status = $request->order_status;
        if($request->order_status == 'COMPLETED'){
            $order->payment_status = 'COMPLETED';
        }
        elseif($request->order_status == 'CANCELLED'){
            $order->payment_status = 'CANCELLED';
        }
        $order->save();
        return back()->with('status','Status Changed successfully!');
    

    }
}
