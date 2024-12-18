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
                <h2>MY ACCOUNT DETAILS</h2>
            </div>
            <div class="d-flex my-20 f-wrap">
                @include('user.usernav')
                <div class="page-content">
                    <div class="contact-div p-15 box-shadow m-10">
                        <div class="contact-method d-flex align-center text-start">
                            <i class="fa-regular fa-user fa-lg"></i>
                            <div class="contact-text">
                                <h6 class="method-title">Name</h6>
                                <p class="form-sub  m-0">{{ $user->name }}</p>
                            </div>
                        </div>
                        <div class="contact-method d-flex align-center">
                            <i class="fa-regular fa-envelope fa-lg"></i>
                            <div class="contact-text text-start">
                                <h6 class="method-title">Email</h6>
                                <p class="form-sub  m-0">{{ $user->email }}</p>
                            </div>
                        </div>
                        
                    </div>
                    <div class="contact-div p-25 box-shadow m-0">
                        @if (Session::has('success'))
                            <p class="alert-msg">{{ Session::get('success') }}</p>
                        @endif
                        <h4 class="form-title">Change Password</h4>
                        <form action="{{ route('user.password.update') }}" method="POST" class="text-center">
                            @csrf
                            @method('PUT')
                            <div class="input-group">
                                <input type="password" name="current_password" placeholder="Old Password" >
                            </div>
                            <div class="input-group">
                                <input type="password" name="new_password" placeholder="New Password" >
                            </div>
                            <div class="input-group">
                                <input type="password" name="new_password_confirmation" placeholder="Confirm Password" >
                            </div>

                            <div class="input-group">
                                <button type="submit" class="form-btn btn-primary w-100">Submit</button>


                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
