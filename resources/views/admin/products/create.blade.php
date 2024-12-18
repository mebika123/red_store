@extends('layouts.admin')
@section('content')
    <div class="d-flex flex-wrap align-items-center justify-content-between">
        <h5 class="fs-4 fw-bolder text-black">Products</h5>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.products') }}">Products</a></li>
                <li class="breadcrumb-item active text-black-50" aria-current="page">Add Products</li>
            </ol>
        </nav>
    </div>

    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12 col-xl-6 mb-20">
                <div class="wg-box">
                    <div class="group-input">
                        <label for="productName" class="form-label fw-bolder">Product Name <span
                                class="text-danger">*</span></label>
                        <input type="text" class="input-field w-100" placeholder="Enter product name" name="name"
                            id="productName" value="{{ old('name') }}">
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
                            id="productSlug" value="{{ old('slug') }}">
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
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
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
                        <textarea class="input-field w-100 " placeholder="Short Description" name="short_description" id="shortDescription">{{ old('short_description') }}</textarea>
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
                        <textarea class="input-field w-100 " placeholder="Description" name="description" id="description">{{ old('description') }}</textarea>
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
                            <div class="item" id="imgpreview" style="display: none">
                                <img src="" alt="" class="effect8">
                            </div>
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
                                    name="regular_price" id="regularPrice" value="{{ old('regular_price') }}">
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
                                    name="sale_price" id="salePrice" value="{{ old('sale_price') }}">
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
                                    id="SKU" value="{{ old('SKU') }}">
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
                                    name="quantity" id="quantity"value="{{ old('quantity') }}">
                                @error('quantity')
                                    <span class="alert alert-danger text-center">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="group-input">
                                <label for="stock" class="form-label fw-bolder">Stock</label>
                                <select name="stock_status" id="stock" class="input-field w-100">
                                    <option value="1">In Stock</option>
                                    <option value="0">Out of Stock</option>
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
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                                @error('featured')
                                    <span class="alert alert-danger text-center">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input mt-4">
                                <input class="btn btn-primary submit-btn f-14 fw-bolder" type="submit"
                                    value="Add Product">
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
