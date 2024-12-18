@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="small-container">

            <div class="page-title my-20">
                <h2>MY ACCOUNT</h2>
            </div>
            <div class="d-flex my-20 f-wrap">
                @include('user.usernav')
                <div class="page-content">
                    <h4>Hello <span class="p-5 mb-25">{{ Auth::user()->name }}</span> </h4>
                    <p>From your account dashboard you can view your recent orders, manage your shipping addresses, and edit
                        your password and account details.</p>
                </div>
            </div>

        </div>
    </div>
@endsection
