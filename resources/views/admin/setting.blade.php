@extends('layouts.admin')
@section('content')
    <div class="row align-items-center justify-content-between">
        <div class="col-md-4 col-xl-3">
            <h5 class="fs-4 fw-bolder text-black">Settings</h5>
        </div>
        <div class="col-md-5 col-xl-2 ">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active text-black-50" aria-current="page">Settings</li>
                </ol>
            </nav>
        </div>
    </div>
    {{-- <form action=""> --}}
    <div class="wg-box mt-3">
        @if (Session::has('success'))
            <p class="alert alert-success">{{ Session::get('success') }}</p>
        @endif
        <div class="row">
            <div class="col-md-3  mt-3">
                <h4 for="userName" class="f-14 fw-bolder">Name</h4>

            </div>
            <div class="col-md-9 mt-3">
                <p class="w-50">{{ $admUser->name }}</p>
            </div>

            <div class="col-md-3  mt-3">
                <h4 for="userName" class="f-14 fw-bolder"> Email Address</h4>

            </div>
            <div class="col-md-9 mt-3">
                <p class="w-50">{{ $admUser->email }}</p>

            </div>

        </div>
        <h5 class="fs-4 fw-bolder text-black my-4">Password Change</h5>
        <div class="group-input">
            <form action="{{ route('admin.user.password.update') }}" method="POST">
                @csrf
                @method('PUT')
                <label for="oldPassword" class="form-label fw-bolder w-25">Old Password <span
                        class="text-danger">*</span></label>
                <input type="Password" class="input-field w-50" placeholder="Old password" name="current_password"
                    id="oldPassword">
        </div>
        <div class="group-input">
            <label for="newPassword" class="form-label fw-bolder w-25">New Password <span class="text-danger">*</span></label>
            <input type="Password" class="input-field w-50" placeholder="New password" name="new_password"
                id="newPassword">
        </div>
        <div class="group-input">
            <label for="confirmPassword" class="form-label fw-bolder w-25">Confirm Password <span
                    class="text-danger">*</span></label>
            <input type="Password" class="input-field w-50" placeholder="Confirm password" name="new_password_confirmation"
                id="confirmPassword">
        </div>
        <div class="group-input">
            <input class="btn btn-primary f-14 fw-bolder" type="submit" value="Save Changes">
        </div>
    </div>

    </form>
@endsection
