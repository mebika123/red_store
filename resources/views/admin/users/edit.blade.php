@extends('layouts.admin')
@section('content')
    <div class="d-flex flex-wrap align-items-center justify-content-between">
        <h5 class="fs-4 fw-bolder text-black">Edit User</h5>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">Users</a></li>
                <li class="breadcrumb-item active text-black-50" aria-current="page">Edit User</li>
            </ol>
        </nav>
    </div>

    <form method="POST" action="{{ route('admin.user.update',['id'=>$user->id]) }}">
        @csrf
        @method('PUT')
        <div class="wg-box">
            <div class="row">
                {{-- <input type="hidden" name="id" value="{{ $user->id }}"> --}}
                <div class="col-md-3  mt-3">
                    <h4 for="userName" class="f-14 fw-bolder"> User Name</h4>
                </div>

                <div class="col-md-9 mt-3">
                    <p>{{ $user->name }}</p>
                </div>
                <div class="col-md-3 mt-3">
                    <h4 for="userEmail" class="f-14 fw-bolder"> User Email</h4>
                </div>
                <div class="col-md-9 mt-3">
                    <p>{{ $user->email }}</p>
                </div>

                <div class="col-md-3 mt-3">
                    <label for="utype" class="form-label fw-bolder"> User Type <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-9 my-3">
                    <select name="utype" id="utype" class="input-field w-25">
                        <option value="ADM" {{ $user->utype == 'ADM' ? 'selected' : '' }}>Admin</option>
                        <option value="USR" {{ $user->utype == 'USR' ? 'selected' : '' }}>User</option>
                    </select>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @error('utype')
                        <span class="alert alert-danger text-center">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-3 mt-3">
                    <div></div>
                </div>
                <div class="col-md-9 mt-3">
                    <input class="btn btn-primary f-14 fw-bolder px-5" type="submit" value="Update">
                </div>

            </div>
        </div>
    </form>
@endsection
