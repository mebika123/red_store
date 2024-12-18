@extends('layouts.admin')
@section('content')
    <div class="d-flex flex-wrap align-items-center justify-content-between">
        <h5 class="fs-4 fw-bolder text-black">New User</h5>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">users</a></li>
                <li class="breadcrumb-item active text-black-50" aria-current="page">New User</li>
            </ol>
        </nav>
    </div>

    <form method="POST" action="{{ route('admin.user.store') }}">
        @csrf
        <div class="wg-box">
            <div class="row">
                <div class="col-md-3  mt-3">
                    <label for="userName" class="form-label fw-bolder"> User Name <span class="text-danger">*</span></label>
                </div>

                <div class="col-md-9 mt-3">
                    <input type="text" class="input-field w-100" placeholder="User name" name="name" id="userName"
                        value={{ old('name') }}>
                    @error('name')
                        <span class="alert alert-danger text-center">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-3 mt-3">
                    <label for="userEmail" class="form-label fw-bolder"> User Email <span
                            class="text-danger">*</span></label>
                </div>
                <div class="col-md-9 mt-3">
                    <input type="email" class="input-field w-100" placeholder="User Email" name="email" id="userEmail"
                        value={{ old('email') }}>
                    @error('email')
                        <span class="alert alert-danger text-center">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-3 mt-3">
                    <label for="password" class="form-label fw-bolder"> Password <span
                            class="text-danger">*</span></label>
                </div>
                <div class="col-md-9 mt-3">
                    <input type="password" class="input-field w-100" placeholder="Password" name="password"
                        value="">
                    @error('password')
                        <span class="alert alert-danger text-center">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-3 mt-3">
                    <label for="password_confirmation" class="form-label fw-bolder"> Confirm password <span
                            class="text-danger">*</span></label>
                </div>
                <div class="col-md-9 mt-3">
                    <input type="password" class="input-field w-100" placeholder="Confirm password" name="password_confirmation" 
                        value="">
                    @error('password_confirmation')
                        <span class="alert alert-danger text-center">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-3 mt-3">
                    <div></div>
                </div>
                <div class="col-md-9 mt-3">
                    <input class="btn btn-primary f-14 fw-bolder px-5" type="submit" value="Save">
                </div>

            </div>
        </div>
    </form>
@endsection
