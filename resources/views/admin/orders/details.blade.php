@extends('layouts.admin')
@section('content')
    <div class="d-flex flex-wrap align-items-center justify-content-between">
        <h5 class="fs-4 fw-bolder text-black">Order Details</h5>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active text-black-50" aria-current="page">Order Item</li>
            </ol>
        </nav>
    </div>

    <div class="wg-box">
        <div class=" row  justify-content-between align-items-content mb-3">
            <div class="col-5">
                <h4>Order Details</h4>
            </div>
            <div class="col-2">
                <a href="{{ route('admin.orders') }}" class="btn btn-outline-primary w-100 py-2">Back</a>
            </div>
        </div>
        <div class="table-responsive">
            @if (Session::has('status'))
            <p class="alert alert-success">{{ Session::get('status')}}</p>
            
        @endif

            <table class="table table-striped table-bordered details-table">
                <tr>
                    <th>Mobile</th>
                    <td>{{ $order->phone }}</td>
                    <th>Order Date</th>
                    <td>{{ $order->created_at }}</td>
                </tr>
                <tr>

                    <th>Cancle Date</th>
                    <td>{{ $order->cancled_date }}</td>

                    <th>Order Status</th>
                    <td colspan="5" class=" text-start">
                        @if ($order->status == 'COMPLETED')
                            <span class="badge bg-success">Delivered</span>
                        @elseif($order->status == 'CANCELLED')
                            <span class="badge bg-danger">Canceled</span>
                        @else
                            <span class="badge bg-success">Ordered</span>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="wg-box mt-5">
        <div class=" row  justify-content-between align-items-content mb-3">
            <div class="col-5">
                <h4>Order Items</h4>
            </div>

        </div>
        <div class="wg-table">
            <div class="table-responsive">
                <table class="table table-striped table-bordered details-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>SKU</th>
                            <th>Category</th>
                            <th>Brand</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                            <tr>
                                <td>
                                    <div class="d-flex gap-2">
                                        <img src="{{ asset('uploads/products/thumbnails') }}/{{ $order->product->image }}"
                                            alt="{{ $order->product->name }}" class="table-image" />

                                        {{-- <div class="product-name text-black f-14">
                                            <a
                                                href="{{ route('shop.product.details', ['product_slug' => $order->product->name]) }}"></a>{{ $order->product->name }}
                                        </div>
                                    </div> --}}
                                </td>
                                <td>${{ $order->amount }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->product->SKU }}</td>
                                <td>{{ $order->product->category->name }}</td>
                                <td>{{ $order->product->brand->name }}</td>
                            </tr>

                    </tbody>
                </table>
            </div>
            {{-- <div class="d-flex align-items-center justify-content-between flex-wrap gap3 wgp-pagnation">
                {{ $order->links('pagination::bootstrap-5') }}
            </div> --}}
        </div>
    </div>

    <div class="wg-box mt-5">
        <h5>Shipping Info</h5>
        <div class="my-account__address-item col-md-6">
            <div class="my-account__address-item__detail mt-4">
                <p>{{ $order->name }}</p>
                <p>{{ $order->address }}</p>
                <p>{{ $order->contact }}</p>
                <p>{{ $order->user->email }}</p>
            </div>
        </div>
    </div>

    <div class="wg-box mt-5">
        <h5>Transactions</h5>
        <table class="table table-striped table-bordered table-transaction">
            <tbody>
                <tr>
                    <th>Quantity</th>
                    <td>{{ $order->quantity }}</td>
                    <th>Total</th>
                    <td>${{ $order->amount }}</td>
                    <th>Status</th>
                    <td>
                        @if($order->payment_status == 'COMPLETED')
                            <span class="badge bg-success">Completed</span>
                            @elseif($order->payment_status == 'CANCELLED')
                            <span class="badge bg-danger">Cancled</span>
                            @elseif($order->payment_status == 'PENDING')
                            {{-- <span class="badge bg-secondary">Refunded</span> --}}
                            <span class="badge bg-danger">Pending</span>
                            @endif
                </tr>

            </tbody>
        </table>
    </div>

    <div class="wg-box mt-5">
        <h5>update Status</h5>
        <form action="{{ route('admin.update.order.status') }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="order_id" value="{{ $order->id }}">
            <div class="row">
                <div class="col-md-3 mt-2">
                    <select name="order_status" id="order_status" class="w-100 py-2 ">
                        <option value="PENDING" {{ $order->status == 'PENDING' ? 'selected' : '' }}>Ordered</option>
                        <option value="COMPLETED" {{ $order->status == 'COMPLETED' ? 'selected' : '' }}>Delivered</option>
                        <option value="CANCELLED" {{ $order->status == 'CANCELLED' ? 'selected' : '' }}>Canceled</option>
                    </select>
                </div>
                <div class="col-md-3 mt-2">
                    <button type="submit" class="btn btn-outline-primary w-100 py-2 ">Update Status</button>
                </div>
            </div>
        </form>
    </div>

    </div>
    </div>
@endsection
