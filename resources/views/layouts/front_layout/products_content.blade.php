<div class="product-container">
    {{-- product box --}}
    @foreach ($products as $product)
        <div class="product-box">
            {{-- image --}}
            <div class="product-img">
                <a href="#" class="add-cart">
                    <i class="fas fa-shopping-cart"></i>
                </a>
                <img src="{{ url('/images/product_image/small/' . $product->image) }}" alt="">
            </div>
            {{-- details --}}
            <div class="product-details">
                <a href="#" class="p-name">{{ $product->product_name_en }}</a>
                <p class="p-price">{{ $product->current_sale_unit_price }}DH</p>
            </div>
        </div>
    @endforeach
</div>
