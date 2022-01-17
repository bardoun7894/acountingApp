
<div class="row justify-content-md-center form-group">
    <div class="col-md-6">
        <label for="purchase_category_id">{{__('messages.category_name')}}</label>
        <select id="purchase_category_id" name="category_id" class="selectCategory form-control"  >
          <optgroup  id="categoryOptGroup" label="{{__('messages.category_level')}}">
              @if(!empty($getCategories))
                @foreach($getCategories as $category)
     {{--             this for purchases page--}}
     <option   @if(isset($categoryData['id']) && $category->id == $categoryData->id)
        selected="" @endif   value="{{$category->id}}"> {{$category->$category_name}} </option>
                    @if(!empty($category->subCategories))
                        @foreach($category->subCategories as $subCategory)
                            <option   value="{{$subCategory->id}}" > &nbsp; &raquo; &nbsp; {{$subCategory->$category_name}} </option>
                        @endforeach
                    @endif
                @endforeach
            @endif
            </optgroup>

        </select>
    </div>
</div>
