<div class="row justify-content-md-center form-group">
    <div class="col-md-6">
        <label for="parent_id">{{ __('messages.category_name') }}</label>
        <select id="parent_id" name="parent_id" class="select3 form-control">
            <optgroup id="categoryOptGroup" label="{{ __('messages.category_level') }}">
                <option id="mainCategory" value="0" @if (!isset($categoryData) && $categoryData->parent_id == 0) selected="" @endif>
                    {{ __('messages.main_category') }}</option>
                @if (!empty($getCategories))
                    @foreach ($getCategories as $category)
                        {{-- this for category page --}}
                        <option @if (isset($categoryData['parent_id']) && $category->id == $categoryData->parent_id) selected="" @endif value="{{ $category->id }}">
                            {{ $category->$category_name }} </option>
                        @if (!empty($category->subCategories))
                            @foreach ($category->subCategories as $subCategory)
                                <option value="{{ $subCategory->id }}"> &nbsp; &raquo; &nbsp;
                                    {{ $subCategory->$category_name }} </option>
                            @endforeach
                        @endif
                    @endforeach

                @endif
            </optgroup>

        </select>
    </div>
</div>
