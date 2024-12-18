@extends('layouts.app')
@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('content')
<div class="account-page">
    <div class="container">
        <div class="row gap-10">
            <div class="col-3 text-center m-0">
                <div class="contact-img"><img src="images/contact.jpg" class="box-shadow"></div>

                <div class="contact-div p-15 box-shadow">
                    <div class="contact-method d-flex align-center">
                        <i class="fa-regular fa-envelope fa-lg"></i>
                        <div class="contact-text text-start">
                            <h6 class="method-title">Email</h6>
                            <p class="form-sub  m-0">mebika@gmail.com</p>
                        </div>
                    </div>
                    <div class="contact-method d-flex align-center text-start">
                        <i class="fa-solid fa-phone fa-lg"></i>
                        <div class="contact-text">
                            <h6 class="method-title">Phone</h6>
                            <p class="form-sub  m-0">9810008986</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-45">
                <div class="contact-div p-25 box-shadow">
                    @if (Session::has('status'))
                    <p class="alert-msg">{{ Session::get('status') }}</p>
                    @endif
                    <h4 class="form-title">Get in Touch</h4>
                    <p class="form-sub">You can reach us anytime</p>
                    <form action="{{ route('home.contact.store') }}" method="POST" class="text-center">
                        @csrf
                        <div class="d-flex justify-between align-center gap-10">
                            <div class="input-group w-50">
                                <input type="text" name="firstName" placeholder="First Name" value="{{ old('firstName') }}">
                            </div>
                            <div class="input-group w-50">
                                <input type="text" name="lastName" placeholder="Last Name" value="{{ old('lastName') }}">
                            </div>
                        </div>
                        <div class="input-group">
                            <input type="email" name="email" placeholder="Your Email" value="{{ old('email') }}">
                        </div>
                        <div class="input-group">
                            <input type="text" name="phone" placeholder="Phone Number" value="{{ old('phone') }}">
                        </div>
                        <div class="input-group">
                            <textarea class="msg-input w-100" name="msg" placeholder="Drop ur message here"
                                rows="8">{{ old('msg') }}</textarea>
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