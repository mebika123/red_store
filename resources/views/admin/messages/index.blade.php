@extends('layouts.admin')
@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
@endpush
@section('content')
    <div class="d-flex flex-wrap align-items-center justify-content-between">
        <h5 class="fs-4 fw-bolder text-black">Messages</h5>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active text-black-50" aria-current="page">All Messages</li>
            </ol>
        </nav>
    </div>

    <div class="wg-box">
        <div class=" row  justify-content-between align-items-content mb-3">
            <div class="col-5">
                <div class="position-relative search-bar d-none d-lg-block">
                    <input type="text" name="search" id="search" placeholder="Search Here...">
                    <i class="fa-solid fa-search"></i>
                </div>
            </div>
        </div>
        <div class="wg-table">
            <div class="table-responsive">
                @if(Session::has('status'))
                <p class="alert alert-success">{{ Session::get('status') }}</p>
            @endif
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="text-start">#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Messages</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($messages as $message)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="product-name text-black f-14">
                                        {{ $message->name }}
                                    </div>
                                </div>
                                </td>
                                <td>{{ $message->phone}}</td>
                                <td>{{ $message->email }}</td>
                                <td class="">{{ $message->message }}</td>
                                <td>
                                    <div class="d-flex align-item-center gap-3">
                                            <form action="{{ route('admin.message.delete',['id'=>$message->id]) }}" method="POST">
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
                {{ $messages->links('pagination::bootstrap-5') }}
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
