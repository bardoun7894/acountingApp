
@extends('layouts.front_layout.layout')
@section('content')

<div class="small-container">
    <div class="row row-2" >
        <h2>All products</h2>
        <form class="sortProducts" id="sortProducts" class="form-horizontal span6">
        <div class="control-group">
            <select name="sort" id="sort">
                <option value="default">Default sorting</option>
                <option value="price_lowest">Low price</option>
                <option value="price_highest">High price</option>
                <option value="latest_products">Latest Products</option>
                <option value="product_name_a_z">product Name A-Z</option>
                <option value="product_name_z_a">product Name Z-A</option>
            </select>
        </div>
        </form>
    </div>
</div>
  <div class="product-container">
    {{-- product box --}}
    @foreach ($products as $product)
        <div class="product-box">
          {{-- image --}}
          <div class="product-img">
            <a href="#" class="add-cart">
              <i class="fas fa-shopping-cart"></i>
            </a>
             <img src="{{url('/images/product_image/small/'.$product->main_image)}}" alt="">
          </div>
          {{-- details --}}
        <div class="product-details">
            <a href="#" class="p-name">{{$product->product_name}}</a>
            <p class="p-price">{{$product->product_price}}DH</p>
        </div>
        </div>
    @endforeach
  </div>


<span>
@if(isset($_GET['sort'])&& !empty($_GET['sort']))
 {{$products->appends(['sort'=>$_GET['sort']])->links("pagination")}}
@else
    {{$products->links("pagination")}}
@endif
</span>
@endsection
