@extends('layouts.admin')
@section('content')
    <div class="d-flex flex-wrap align-items-center justify-content-between">
        <h5 class="fs-4 fw-bolder text-black">Brands</h5>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active text-black-50" aria-current="page">Brands</li>
            </ol>
        </nav>
    </div>

    <div class="wg-box">
        <div class=" row  justify-content-between align-items-content mb-3">
            <div class="col-md-6 col-lg-7 mb-4 mb-md-0">
                <div class="position-relative search-bar w-100">
                    <input type="text" name="search" id="search2" placeholder="Search Here...">
                    <i class="fa-solid fa-search"></i>
                </div>
            </div>
            <div class="col-4 col-md-3 col-xl-2 ">
                <a href="{{ route('admin.brand.add') }}" class="btn btn-outline-primary w-100 py-2">+ Add new</a>
            </div>
        </div>
        <div class="wg-table">
            <div class="table-responsive">
                @if(Session::has('status'))
                    <p class="alert alert-success">{{ Session::get('status') }}</p>
                @endif
                <table class="table table-striped table-bordered details-table">
                    <thead>
                        <tr>
                            <th class="text-start">#</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach($brands as $brand)
                        <tr>
                            <td>{{ $brand->id }}</td>
                            <td>
                                {{-- <div class="d-flex gap-2"> --}}
                                    {{-- <img src="{{asset('uploads/brands') }}/{{ $brand->image }}" alt="{{ $brand->name }}"> --}}
                                    <div class="product-name text-black f-14">
                                        {{ $brand->name }}
                                    </div>
                                {{-- </div> --}}
                            </td>
                            <td>
                                <p class="f-12 ">{{ $brand->slug }}</p>
                            </td>
                            <td>
                                <div class="d-flex align-item-center gap-3">
                                    <a href="{{ route('admin.brand.edit',['id'=>$brand->id]) }}">
                                        <i class="fa-solid fa-pen text-success"></i>
                                    </a>
                                    <form action="{{ route('admin.brand.delete',['id'=>$brand->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a class="delete">
                                            <i class="fa-regular fa-trash-can text-danger"></i>
                                        </a>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-between flex-wrap gap3 wgp-pagnation">
            {{ $brands->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
@push('script')
<!-- Include SweetAlert v1 CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

<script>
    $(function(){
        $('.delete').on('click',function(e){
            e.preventDefault();
            var form = $(this).closest('form');
            swal({
                title: "Are you sure?",
                text: "You want to delete this file",
                type: "warning",  // In SweetAlert v1, `type` works
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
            }, function(isConfirm){
                if (isConfirm) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush
