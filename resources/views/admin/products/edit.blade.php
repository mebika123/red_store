@extends('layouts.admin')
@section('content')
    <div class="d-flex flex-wrap align-items-center justify-content-between">
        <h5 class="fs-4 fw-bolder text-black">Edit Product</h5>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.products') }}">Products</a></li>
                <li class="breadcrumb-item active text-black-50" aria-current="page">Edit Product</li>
            </ol>
        </nav>
    </div>

    <form action="{{ route('admin.product.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $product->id }}">
        <div class="row">
            <div class="col-12 col-xl-6 mb-20">
                <div class="wg-box">
                    <div class="group-input">
                        <label for="productName" class="form-label fw-bolder">Product Name <span
                                class="text-danger">*</span></label>
                        <input type="text" class="input-field w-100" placeholder="Enter product name" name="name"
                            id="productName" value="{{ $product->name }}">
                        <p class="f-12 mt-1 text-black-50">Do not exceed 100 characters when entering
                            the
                            product</p>
                        @error('name')
                            <span class="alert alert-danger text-center">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="group-input">
                        <label for="productSlug" class="form-label fw-bolder">SLug <span
                                class="text-danger">*</span></label>
                        <input type="text" class="input-field w-100" placeholder="Enter product slug" name="slug"
                            id="productSlug" value="{{ $product->slug }}">
                        <p class="f-12 mt-1 text-black-50">Do not exceed 100 characters when entering
                            the
                            product</p>
                        @error('slug')
                            <span class="alert alert-danger text-center">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="group-input">
                                <label for="Category" class="form-label fw-bolder">Category<span
                                        class="text-danger">*</span></label>
                                <select name="category_id" id="Category" class="input-field w-100">
                                    <option value="">Choose Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? "selected":"" }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="alert alert-danger text-center">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="group-input">
                                <label for="brand" class="form-label fw-bolder">Brand<span
                                        class="text-danger">*</span></label>
                                <select name="brand_id" id="brand" class="input-field w-100">
                                    <option value="">Choose Brand</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}"{{ $product->brand_id == $brand->id ? "selected":"" }}>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                    <span class="alert alert-danger text-center">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="group-input">
                        <label for="shortDescription" class="form-label fw-bolder">Short Description
                            <span class="text-danger">*</span></label>
                        <textarea class="input-field w-100 " placeholder="Short Description" name="short_description" id="shortDescription">{{ $product->short_description }}</textarea>
                        <p class="f-12 mt-1 text-black-50">Do not exceed 100 characters when entering
                            the
                            product</p>
                        @error('short_description')
                            <span class="alert alert-danger text-center">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="group-input">
                        <label for="description" class="form-label fw-bolder">Description <span
                                class="text-danger">*</span></label>
                        <textarea class="input-field w-100 " placeholder="Description" name="description" id="description">{{ $product->description }}</textarea>
                        <p class="f-12 mt-1 text-black-50">Do not exceed 100 characters when entering
                            the
                            product</p>
                        @error('description')
                            <span class="alert alert-danger text-center">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-6 mb-20">
                <div class="wg-box">
                    <div class="group-input">
                        <label for="myFile" class="form-label fw-bolder">Upload Image <span
                                class="text-danger">*</span></label>

                        <div class="d-flex align-items-center flex-wrap gap-4">
                            <div class="image-input drage-area">
                                <div class=" icon text-primary mb-2 ">
                                    <i class="fa-solid fa-cloud-arrow-up icon-upload fa-3x"></i>
                                </div>
                                <input type="file" name='image' id="myFile" hidden>
                                <span class="text-image text-black-50">Drop your image here or</span>
                                <span class="text-image text-black-50">select <span class="button text-primary">click to
                                        browse</span></span>
                            </div>
                            @if($product->image)
                            <div class="item" id="imgpreview" style="">
                                <img src="{{ asset('uploads/products') }}/{{ $product->image }}" alt="{{ $product->name }}" class="effect8">
                            </div>
                            @endif
                        </div>

                        @error('image')
                            <span class="alert alert-danger text-center">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="group-input">
                        <label for="gFile" class="form-label fw-bolder">Upload Gallery Image<span
                                class="text-danger">*</span></label>
                        <div class="d-flex align-items-center flex-wrap gap-4" id="galUpload">
                            <div class="image-input drage-area">
                                <div class=" icon text-primary mb-2 ">
                                    <i class="fa-solid fa-cloud-arrow-up icon-upload fa-3x"></i>
                                </div>
                                <input type="file" name='images[]' id="gFile" accept="image/*" multiple hidden>
                                <span class="text-image text-black-50">Drop your image here or</span>
                                <span class="text-image text-black-50">select <span class="button text-primary">click
                                        to
                                        browse</span></span>
                            </div>
                            @if($product->images)
                                @foreach ( explode(',',$product->images ) as $img )
                                <div class="item gimg" style="">
                                    <img src="{{ asset('uploads/products') }}/{{ trim($img) }}" alt="{{ $product->name }}" class="effect8">
                                </div>
                                @endforeach
                            @endif
                        </div>
                        @error('images')
                            <span class="alert alert-danger text-center">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="group-input">
                                <label for="regularPrice" class="form-label fw-bolder">Regular Price
                                    <span class="text-danger">*</span></label>
                                <input type="text" class="input-field w-100" placeholder="Enter regular price"
                                    name="regular_price" id="regularPrice" value="{{ $product->regular_price }}">
                                @error('regular_price')
                                    <span class="alert alert-danger text-center">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="group-input">
                                <label for="salePrice" class="form-label fw-bolder">Sale Price <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="input-field w-100" placeholder="Enter sale price"
                                    name="sale_price" id="salePrice" value="{{ $product->sale_price }}">
                                @error('sale_price')
                                    <span class="alert alert-danger text-center">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="group-input">
                                <label for="SKU" class="form-label fw-bolder">SKU <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="input-field w-100" placeholder="Enter SKU" name="SKU"
                                    id="SKU" value="{{ $product->SKU }}">
                                @error('SKU')
                                    <span class="alert alert-danger text-center">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="group-input">
                                <label for="quantity" class="form-label fw-bolder">Quantity <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="input-field w-100" placeholder="Enter quantity"
                                    name="quantity" id="quantity"value="{{ $product->quantity }}">
                                @error('quantity')
                                    <span class="alert alert-danger text-center">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="group-input">
                                <label for="stock" class="form-label fw-bolder">Stock</label>
                                <select name="stock_status" id="stock" class="input-field w-100">
                                    <option value="1" {{ $product->stock_status == "1" ? "selected":"" }}>In Stock</option>
                                    <option value="0" {{ $product->stock_status == "0" ? "selected":"" }}>Out of Stock</option>
                                </select>
                                @error('stock_status')
                                    <span class="alert alert-danger text-center">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="group-input">
                                <label for="featured" class="form-label fw-bolder">Featured</label>
                                <select name="featured" id="featured" class="input-field w-100">
                                    <option value="0" {{ $product->featured == "0" ? "selected":"" }}>No</option>
                                    <option value="1" {{ $product->featured == "1" ? "selected":"" }}>Yes</option>
                                </select>
                                @error('featured')
                                    <span class="alert alert-danger text-center">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input mt-4">
                                <input class="btn btn-primary submit-btn f-14 fw-bolder" type="submit"
                                    value="Edit Product">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </form>
@endsection
@push('script')
    <script>
        $(function() {
            $("#myFile").on('change', function(e) {
                const photoInp = $('#myFile');
                const [file] = this.files;
                if (file) {
                    $("#imgpreview img").attr('src', URL.createObjectURL(file));
                    $('#imgpreview').show();
                }
            });

            $("#gFile").on('change', function(e) {
                const photoInp = $('#gFile');
                const gphotos = this.files;
                $.each(gphotos, function(key, val) {
                    $("#galUpload").append(
                        `<div class="item gitems"><img src="${URL.createObjectURL(val)}"/></div>`
                    );
                });
                $('.gimg').hide();
            });

            $("input[name='name']").on("change", function() {
                $("input[name='slug']").val(StringToSlug($(this).val()));
            });
        });

        function StringToSlug(Text) {
            return Text.toLowerCase()
                .replace(/[^\w]+/g, "")
                .replace(/ + /g, "-");
        }
    </script>
@endpush
