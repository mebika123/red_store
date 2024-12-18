@extends('layouts.app')
@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('content')
    @auth
        <div class="order-modal d-none" id="modalbox">
            <div class="contact-div p-15 box-shadow modalbox">
                <div class="d-flex justify-between align-center">
                    <h4 class="form-title text-center">Order Product</h4>
                    <i class="fa-solid fa-xmark fa-xl btn-cancel"></i>

                </div>
                <form action="{{ route('user.order.save') }}" method="POST">
                    @csrf
                    <p class="f-16 mt-20 text-black"><strong>Please fill this form</strong></p>
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    {{-- <div class="input-group">
                        <input type="email" name="email" placeholder="Your Email" value="{{ old('email') }}">
                    </div> --}}
                    <div class="input-group">
                        <input type="text" name="phone" placeholder="Phone Number" value="{{ old('phone') }}">
                    </div>
                    @error('phone')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                    <div class="input-group">
                        <input type="text" name="address" placeholder="Address" value="{{ old('address') }}">
                    </div>
                    <div class="qty-btn d-flex align-center">
                        <i class="fa-solid fa-plus qty-modifier fa-xs"></i>
                        <input type="number" name="quantity" class="qty-amt m-0" value="1" max="{{ $product->quantity }}">
                        <i class="fa-solid fa-minus qty-modifier fa-xs"></i>
                    </div>
                    @error('quantity')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                    <div class="input-group mb-15">
                        <label for="payment">Payment Method</label><br>
                        <input type="radio" name="payment" value="cod" class="radio-btn">Cash on Delivery<br>
                        <input type="radio" name="payment" value="esewa" class="radio-btn">Esewa
                    </div>
                    @error('payment')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                    <div class="input-group text-center">
                        <button type="submit" class="form-btn btn-primary w-40">Submit</button>
                        <button type="button" class="form-btn btn-primary w-40 btn-danger btn-cancel">Cancel</button>

                        <!-- <input type="submit" value="Submit" class="btn-primary form-btn"> -->
                    </div>

                </form>
            </div>
        </div>
    @endauth

    <!------------------------------ Single product details------------------------------>
    <div class="small-container single-product">


        <!--<h2 class="title" >Featured Products</h2>-->
        <div class="row">
            <div class="col-2">
                <img src="{{ asset('uploads/products') }}/{{ $product->image }}" width="100%" id="productImg">


                <div class="small-img-row">
                    @foreach (explode(',', $product->images) as $gimg)
                        <div class="small-img-col">
                            <img src="{{ asset('uploads/products') }}/{{ $gimg }}" width="100%" class="small-img">
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-2">
                @if (Session::has('success'))
                    <p class="alert-msg">{{ Session::get('success') }}</p>
                @endif
                <p>Home / Shoes</p>
                <h1>{{ $product->name }}</h1>
                <p><span class="text-black">Price:</span>
                    @if ($product->sale_price < $product->regular_price)
                        <s>{{ $product->regular_price }}</s> ${{ $product->sale_price }}
                    @else
                        ${{ $product->regular_price }}
                    @endif
                </p>
                <p> <span class="text-black">Available stock:</span>  {{ $product->quantity }}</p>

                {{-- <div class="qty-btn d-flex align-center">
                    <i class="fa-solid fa-plus qty-modifier fa-xs"></i>
                    <input type="number" name="qty" class="qty-amt m-0" value="1" max="{{ $product->quantity }}">
                    <i class="fa-solid fa-minus qty-modifier fa-xs"></i>
                </div> --}}
                <div>
                    @guest
                        <p class="f-16 my-15 invalid-feedback"> Please <a href="{{ route('login-register') }}"
                                class="color-primary">Login</a>
                            to place your order.</p>
                    @else
                        <button class="btn form-btn" id="modal-open">Place Order</button>
                    @endguest

                </div>



                <h3>Product Details <i class="fa fa-indent"></i></h3>
                <br>
                <p>{{ $product->description }}</p>
            </div>
        </div>
    </div>


    <!----------------------------------Title------------------------------------->
    <div class="small-container">
        <div class="row row-2 m-a">
            <h2>Related Products</h2>
            <a href="{{ route('shop.index') }}">
                <p>View More</p>
            </a>
        </div>
    </div>

    <!----------------------------------products------------------------------------->
    <div class="small-container">
        <div class="row">
            @foreach ($rproducts as $rproduct)
                <div class="col-4">
                    <a href="{{ route('shop.product_details', ['slug' => $product->slug]) }}">
                        <img src="{{ asset('uploads/products') }}/{{ $rproduct->image }}">
                        <p class="f-12">{{ $rproduct->category->name }}</p>
                        <h4 class="text-black">{{ $rproduct->name }}</h4>
                    </a>
                    <div class="rating">

                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <i class="fa fa-star-o"></i>
                    </div>
                    <p>
                        @if ($rproduct->sale_price < $rproduct->regular_price)
                            <s>{{ $rproduct->regular_price }}</s> ${{ $rproduct->sale_price }}
                        @else
                            ${{ $rproduct->regular_price }}
                        @endif
                    </p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@push('script')
    <script>
        var productImg = document.getElementById("productImg");
        var smallImg = document.getElementsByClassName("small-img");

        for (let i = 0; i < smallImg.length; i++) {
            smallImg[i].onclick = function() {
                productImg.src = smallImg[i].src;
            };
        }


        // Select all quantity buttons
        var qtyBtn = document.querySelectorAll('.qty-btn');
        var quantity = document.querySelector("input[name='quantity']");

        // Loop through each quantity button group
        qtyBtn.forEach(function(item) {
            // Safely query the add and subtract buttons
            const add = item.querySelector('.fa-plus');
            const sub = item.querySelector('.fa-minus');
            var amt = item.querySelector('.qty-amt'); // Input field for the quantity

            // Ensure all elements exist before adding event listeners
            if (add && sub && amt) {
                // Increment button
                add.addEventListener('click', function() {
                    let currentValue = parseInt(amt.value) || 0;
                    if (currentValue < {{ $product->quantity }}) {
                        amt.value = currentValue + 1;
                    }
                });

                // Decrement button
                sub.addEventListener('click', function() {
                    let currentValue = parseInt(amt.value) || 0;
                    if (currentValue > 1) {
                        amt.value = currentValue - 1;
                    }
                });
            }
        });



        var modalbox = document.getElementById('modalbox');
        var openModal = document.getElementById('modal-open')
        if (openModal) {
            openModal.addEventListener('click', function() {
                modalbox.classList.remove('d-none');
                document.body.classList.add('overflow-hidden')
            })
        }
        var closeModal = document.querySelectorAll('.btn-cancel')
        closeModal.forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                modalbox.classList.add('d-none');
                document.body.classList.remove('overflow-hidden')
                e.stopPropagation

            })
        })
    </script>
@endpush
