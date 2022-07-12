<?php

?>
@extends('layouts.front_layout.layout')
@section('content')
    {{-- sidebar --}}
    <div class="grid">
        <div class="col-1-3">
            <div>
                <div class="block-title">
                    <h3>Category</h3>
                </div>
                <ul class="block-content">
                    @foreach ($categories as $category)
                        <li>
                            <input type="checkbox">
                            <label for="">
                                <span>{{ $category['category_name'] }}</span>
                                <input name="category_id[]" value="{{ $category['id'] }}">
                                <small class="count_products_small">d</small>
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
        <div class="col-2-3">
            <div class="small-container">
                <div class="row row-2">
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

            <div class="filter_products">
                @include('layouts.front_layout.products_content')
            </div>

            {{-- <span>
                @if (!empty($d))
                    @if (isset($d) && !empty($d))
                        {{ $products->appends(['sort' => $d])->links('pagination') }}
                    @else
                        {{ $products->links('pagination') }}
                    @endif
                @else
                    @if (isset($_GET['sort']) && !empty($_GET['sort']))
                        {{ $products->appends(['sort' => $_GET['sort']])->links('pagination') }}
                    @else
                        {{ $products->links('pagination') }}
                    @endif
                @endif

            </span> --}}
        </div>
    </div>
@endsection
