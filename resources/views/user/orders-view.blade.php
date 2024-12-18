@extends('layouts.app')
@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('content')
    <div class="container">

        <div class="small-container">

            <div class="page-title my-20">
                <h2>MY ACCOUNT</h2>
            </div>
            <div class="d-flex my-20 f-wrap">
                @include('user.usernav')
                <div class="page-content">
                    <div class="order-div" style="overflow-x: scroll;">
                        @if (Session::has('status'))
                        <p class="alert-msg bg-red my-15 w-100">{{ Session::get('status') }}</p>
                    @endif
                        <table class="order-table">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Item</th>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Address</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Payment Status</th>
                                    <th>Order Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($orders->isEmpty())
                                    <tr>
                                        <td colspan="11" class="text-center"><strong>No orders found</strong></td>
                                    </tr>
                                @else
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $order->product->name }}</td>
                                            <td>{{ $order->name }}</td>
                                            <td>{{ $order->contact }}</td>
                                            <td>{{ $order->address }}</td>
                                            <td>{{ $order->amount }}</td>
                                            <td>{{ $order->quantity }}</td>
                                            <td>{{ $order->status }}</td>
                                            <td>{{ $order->payment_status }}</td>
                                            <td>{{ $order->created_at }}</td>
                                            <td>
                                                @if($order->status != 'CANCELLED')
                                                <form action="{{ route('user.order.delete',['id'=>$order->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="submit" class="btn m-0" value="Cancel">
                                                </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div>
                        {{ $orders->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
