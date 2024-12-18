@extends('layouts.app')
@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endpush
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-2">
                <h1>Give your Workout <br>A New Style!</h1>
                <p>Success isn't always about greatness. It's about consistency. Consistent<br>hard work gains
                    success. Greatness will come.</p>
                <a href="#" class="btn">Explore Now &#8594;</a>
            </div>
            <div class="col-2">
                <img src="images/image1.png">
            </div>
        </div>
    </div>
    <!------------------------------ featured categories------------------------------>
    <div class="categories">
        <div class="small-container">
            <h2 class="title">Categories</h2>
            <div class="swiper mySwiper swiperCategory">
                <div class="swiper-wrapper">
                    @foreach ($categories as $category )
                    <div class="swiper-slide">
                        <div class="category-img category">
                            <input type="hidden" name="category" value="{{ $category->id }}">
                            <img src="{{ asset('uploads/categories/') }}/{{ $category->image }}">
                        </div>
                    </div>
                    @endforeach
                    
                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </div>

    <!------------------------------ featured Products------------------------------>
    <div class="small-container">
        <h2 class="title">Featured Products</h2>
        <div class="row">
            @foreach ($fproducts as $fproduct )
            <div class="col-4">
                <a href="{{ route('shop.product_details',['slug'=>$fproduct->slug]) }}">
                    <img src="{{ asset('uploads/products') }}/{{ $fproduct->image }}">
                    <h4>{{ $fproduct->name }}</h4>
                </a>
                <div class="rating">
                    <!--(before this added awesome4 cdn font link to the head)added a cdn link by searching font awesome4 icon and from the site  search the star entering the first option and getting a link of this fa-star*-->
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-o"></i>
                    <i class="fa fa-star-o"></i>
                </div>
                <p>
                    @if ($fproduct->sale_price < $fproduct->regular_price )
                    <s>{{ $fproduct->regular_price }}</s> ${{ $fproduct->sale_price }}
                @else
                    ${{ $fproduct->regular_price }}
                @endif
                </p>
            </div>
            @endforeach
        </div>


        <h2 class="title">Latest Products</h2>
        <div class="row">
            @foreach ($lproducts as $lproduct )
            <div class="col-4">
                <a href="{{ route('shop.product_details',['slug'=>$lproduct->slug]) }}">
                    <img src="{{ asset('uploads/products') }}/{{ $lproduct->image }}">
                    <h4>{{ $lproduct->name }}</h4>
                </a>
                <div class="rating">
                    <!--(before this added awesome4 cdn font link to the head)added a cdn link by searching font awesome4 icon and from the site  search the star entering the first option and getting a link of this fa-star*-->
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-o"></i>
                    <i class="fa fa-star-o"></i>
                </div>
                <p>
                    @if ($lproduct->sale_price < $lproduct->regular_price)
                    <s>{{ $lproduct->regular_price }}</s> ${{ $lproduct->sale_price }}
                @else
                    ${{ $lproduct->regular_price }}
                @endif
                </p>
            </div>
            @endforeach

        </div>

    </div>

    <!--------------------------`   offer   --------------------------------->
    <div class="offer">
        <div class="small-container">
            <div class="row">
                <div class="col-2">
                    <img src="{{ asset('images/image1.png') }}" class="offer-img">
                </div>
                <div class="col-2">
                    <p>Exclusively Available on RedStore</p>
                    <h1>Sports Shoes</h1>
                    <small> Buy latest collections of sports shoes online on Redstore at best prices from top brands such as
                        Adidas, Nike, Puma, Asics, and Sparx at your leisure at best prices. </small><br>
                    <a href="{{ route('shop.index') }}" class="btn">Buy Now &#8594;</a>
                </div>
            </div>
        </div>
    </div>



    <!------------------------------Testimonial---------------------------------->
    <div class="testimonial">
        <div class="small-container">
            <div class="row">
                <div class="col-3">
                    <i class="fa fa-quote-left"></i>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                        industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type
                        and scrambled it to make a type specimen book. </p>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                    </div>
                    <img src="images/user-1.png">
                    <h3>Sean Parkar</h3>
                </div>
                <div class="col-3">
                    <i class="fa fa-quote-left"></i>
                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when
                        looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal
                        distribution of letters, as opposed to using 'Content here, content here', making it look like
                        readable English.</p>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                    </div>
                    <img src="images/user-2.png">
                    <h3>Mike Smith</h3>
                </div>
                <div class="col-3">
                    <i class="fa fa-quote-left"></i>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                        industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type
                        and scrambled it to make a type specimen book. </p>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                    </div>
                    <img src="images/user-3.png">
                    <h3>Mabel Joe</h3>
                </div>
            </div>
        </div>
    </div>

    <!----------------------------------Brands------------------------------------>
    <div class="brands">
        <div class="small-container">
            <div class="row">
                <div class="col-5">
                    <img src="{{ asset('images/logo-godrej.png') }}" alt="">
                </div>
                <div class="col-5">
                    <img src="{{ asset('images/logo-oppo.png') }}" alt="">
                </div>
                <div class="col-5">
                    <img src="{{ asset('images/logo-coca-cola.png') }}" alt="">
                </div>
                <div class="col-5">
                    <img src="{{ asset('images/logo-paypal.png') }}" alt="">
                </div>
                <div class="col-5">
                    <img src="{{ asset('images/logo-philips.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('shop.index') }}" method="GET" id="fltform">
        <input type="hidden" name="hdncategory" id="hdnCategories">
    </form>
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".swiperCategory", {
            slidesPerView: 1,
            centerInsufficientSlides: true,
            // spaceBetween: 10,
            breakpoints: {
                
                576: {
                    slidesPerView:2,
                    spaceBetween: 30,
                },
                768: {
                    slidesPerView:3,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView:4,
                    spaceBetween: 40,
                },
                1200: {
                    slidesPerView: 4,
                    spaceBetween: 30,
                },
            },
            // centeredSlides: true,
            pagination: {
                el: ".swiper-pagination",
                dynamicBullets: true,
                clickable: true,
            },
        });
        var categoryItem = document.querySelectorAll(".category")
    categoryItem.forEach(function(item){
        item.addEventListener("click",function(){
            var value = item.querySelector("input[name='category']").value;
            document.getElementById('hdnCategories').value = value;
            document.getElementById('fltform').submit();
        })
    })
    </script>
@endpush
