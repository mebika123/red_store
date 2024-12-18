@extends('layouts.admin')
@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
@endpush
@section('content')
    <div class="d-flex flex-wrap align-items-center justify-content-between">
        <h5 class="fs-4 fw-bolder text-black">Users</h5>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active text-black-50" aria-current="page">All Users</li>
            </ol>
        </nav>
    </div>

    <div class="wg-box">
        <div class=" row  justify-content-between align-items-content mb-3">
            <div class="col-5">
                <div class="position-relative search-bar d-none d-lg-block">
                    <input type="text" name="search" placeholder="Search Here...">
                    <i class="fa-solid fa-search"></i>
                </div>
            </div>
            <div class="col-2">
                <a href="{{ route('admin.user.create') }}" class="btn btn-outline-primary w-100 py-2">+ Add new</a>
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
                            <th>Email</th>
                            <th>utype</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
                                    <div class="product-name text-black f-14">
                                        {{ $user->name }}
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->utype }}</td>
                                <td>
                                    <div class="d-flex align-item-center gap-3">
                                            <a href="{{ route('admin.user.edit',['id'=>$user->id]) }}">
                                                <i class="fa-solid fa-pen text-success"></i>
                                            </a>
                                            <form action="{{ route('admin.user.delete',['id'=>$user->id]) }}" method="POST">
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
            <div class="d-flex align-items-center justify-content-between flex-wrap gap3 wgp-pagnation">
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
@push('script')
<!-- Include SweetAlert v1 CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

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
