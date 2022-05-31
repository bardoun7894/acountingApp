<div class="row justify-content-md-center form-group">
    <div class="col-md-6">
        <label for="stock_id">{{ __('messages.product_name') }}</label>
        <select id="stockId" name="stock_id" class="select3 form-control">
            <optgroup id="productOptGroup" label="{{ __('messages.product_level') }}">
                @if (!empty($getProducts) && count($getProducts) > 0)
                    @foreach ($getProducts as $product)
                        <option @if (isset($productData['id']) && $product->id == $productData->id) selected="" @endif value="{{ $product->id }}">
                            {{ $product->$product_name }} </option>
                    @endforeach
                @else
                    <option value="" selected=""><a
                            href="/stock">::</a>{{ __('messages.no_product_found_add_product') }}</option>

                @endif

            </optgroup>

        </select>
    </div>
</div>
