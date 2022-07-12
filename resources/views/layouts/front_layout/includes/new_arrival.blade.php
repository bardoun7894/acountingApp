<section class="new-arrival">
    <div class="arrival-heading">
        <strong> New Arrival</strong>
        <p>We provide you new design Fashion Clothes</p>
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
                    <img src="{{ url('/admin/app-assets/images/products/IMG_3142.JPG') }}" alt="">
                </div>
                {{-- details --}}
                <div class="product-details">
                    <a href="{{ url('/' . App::getLocale() . '/front/products') }}"
                        class="p-name">{{ $product->product_name_en }}</a>
                    <p class="p-price">{{ $product->current_sale_unit_price }} DH</p>
                </div>
            </div>
        @endforeach

    </div>
</section>
