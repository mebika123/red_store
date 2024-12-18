@extends('layouts.app')
@section('content')
    <div class="container">

        <!------------------------------ Products------------------------------>
        <div class="small-container">

            <div class="cagegory-section">
                <ul class="category-row">
                    @foreach ( $categories as $category )
                    <li class="p-15 category-item  @if (in_array($category->id,explode(',',$f_category)))
                             category-checked
                         @endif">
                         <input type="checkbox" name="category" value="{{ $category->id }}" style="display: none" 
                         @if (in_array($category->id,explode(',',$f_category)))
                             checked
                         @endif
                         >
                         {{ $category->name }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="row row-2 my-20">
                <h2>All Products</h2>
                <select name="orderby" id="orderby">
                    <option value="-1" {{ $order ==-1 ? 'selected' : '' }}>Default</option>
                    <option value="1" {{ $order ==1 ? 'selected' : '' }}>Date, New To Old</option>
                    <option value="2" {{ $order ==2 ? 'selected' : '' }}>Date, Old To New</option>
                    <option value="3" {{ $order ==3 ? 'selected' : '' }}>Price, Low To High</option>
                    <option value="4" {{ $order ==4 ? 'selected' : '' }}>Price, High To Low</option>
                  </select>
            </div>

            <!--<h2 class="title" >Featured Products</h2>-->
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-4">
                        <a href="{{ route('shop.product_details',['slug'=>$product->slug]) }}">
                            <img src="{{ asset('uploads/products') }}/{{ $product->image }}">

                            <p class="f-12">{{ $product->category->name }}</p>
                            <h4 class="text-black">{{ $product->name }}</h4>
                        </a>
                        <div class="rating">

                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <p>
                            @if ($product->sale_price < $product->regular_price)
                                <s>{{ $product->regular_price }}</s> ${{ $product->sale_price }}
                            @else
                                ${{ $product->regular_price }}
                            @endif
                        </p>
                    </div>
                @endforeach

            </div>

            <div class="page-btn">
                <span>{{ $products->links('pagination::bootstrap-5') }}</span>

            </div>

        </div>
    </div>
    <form action="{{ route('shop.index') }}" method="GET" id="fltform">
        <input type="hidden" name="hdncategory" id="hdnCategories">
        <input type="hidden" id="order" name="order" value="{{ $order}}">
    </form>
@endsection
@push('script')
<script>
var categoryItems = document.querySelectorAll(".category-item");
var categoryValue = document.getElementById('hdnCategories');

categoryItems.forEach(function(item) {
    item.addEventListener("click", function() {
        categoryValue.value ="";
        item.querySelector('input').checked = !item.querySelector('input').checked;

        document.querySelectorAll("input[name='category']:checked").forEach(function(val){
            if (categoryValue.value === "") {
                categoryValue.value = val.value;
            } 
            else {
                categoryValue.value += ',' + val.value;
            }
        })
        console.log(categoryValue.value)
        document.getElementById('fltform').submit(); 
    });
});

    var orderBy = document.getElementById('orderby');
    orderBy.addEventListener('change',function(){
        document.getElementById('order').value = orderBy.value;
        document.getElementById('fltform').submit();

    })
</script>
    
@endpush
