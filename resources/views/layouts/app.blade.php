<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!--added a cdn link by searching font awesome4 cdn and getting this link from https://www.bootstrapcdn.com/fontawesome/ this url*/-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    @stack('style')

    <title>{{ config('app.name', 'Laravel') }}</title>


</head>

<body>
    <div class ="header">
        <div class="container">
            <div class="navbar">
                <div class="logo">
                    <a href="{{ route('home.index') }}"><img src="{{ asset('images/logo.png') }}" width="125px"></a>
                </div>
                <nav>
                    <ul id="MenuItems">
                        <li><a href="{{ route('home.index') }}">Home</a></li>
                        <li><a href="{{ route('shop.index') }}">Products</a></li>
                        <li><a href="">About</a></li>
                        <li><a href="{{ route('home.contact') }}">Contact</a></li>
                        @guest
                        <li><a href="{{ route('login-register') }}">Account</a></li>
                        @else
                        <li> <span class="p-5">{{ Auth::user()->name }}</span> <a href="{{ Auth::user()->utype === 'ADM' ? route('admin.index') : route('user.index') }}">Account</a></li>
                        @endguest

                    </ul>
                </nav>
                <a href="cart.html"><img src="{{ asset('images/cart.png') }}" width="30px" height="30px"></a>
                <img src="{{ asset('images/menu.png') }}" class="menu-icon" onClick="menutoggle()">
            </div>
            {{-- <div class="row">
                <div class="col-2">
                    <h1>Give your Workout <br>A New Style!</h1>
                    <p>Success isn't always about greatness. It's about consistency. Consistent<br>hard work gains
                        success. Greatness will come.</p>
                    <a href="products.html" class="btn">Explore Now &#8594;</a>
                </div>
                <div class="col-2">
                    <img src="images/image1.png">
                </div>
            </div> --}}
        </div>
    </div>

   @yield('content')


    <!----------------------------------footer------------------------------------->
    <div class ="footer">
        <div class="container">

            <div class="row">
                <div class="footer-col-1">
                    <h3>Download Our App</h3>
                    <p>Download App for Android and ios mobile phone.</p>
                    <div class="app-logo">
                        <img src="{{asset('images/play-store.png')}}" alt="">
                        <img src="{{asset('images/app-store.png')}}" alt="">
                    </div>
                </div>
                <div class="footer-col-2">
                    <img src="{{ asset('images/logo-white.png') }}">
                    <p>Our Purpose Is To Sustainably Make the Pleasure and Benefits of Sports Accessible to the Many.
                    </p>
                </div>
                <div class="footer-col-3">
                    <h3>Useful Links</h3>
                    <ul>
                        <li>Coupons</li>
                        <li>Blog Post</li>
                        <li>Return Policy</li>
                        <li>Join Affiliate</li>
                    </ul>
                </div>
                <div class="footer-col-4">
                    <h3>Follow us</h3>
                    <ul>
                        <li>Facebook</li>
                        <li>Twitter</li>
                        <li>Instagram</li>
                        <li>Youtube</li>
                    </ul>
                </div>

            </div>

            <hr><!--horizontal line-->
            <p class="copyright">Copyright 2021 - Apurba Kr. Pramanik</p>

        </div>
    </div>


    <!-----------------------------------js for toggle menu----------------------------------------------->
    @stack('script')
    <script>
        var menuItems = document.getElementById("MenuItems");

        MenuItems.style.maxHeight = "0px";

        function menutoggle() {
            if (MenuItems.style.maxHeight == "0px") {
                MenuItems.style.maxHeight = "200px";
            } else {
                MenuItems.style.maxHeight = "0px";
            }
        }
    </script>
</body>

</html>
