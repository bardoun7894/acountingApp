<div class="row justify-content-md-center form-group">
    <div class="col-md-6">
        <label  for="branchId">{{__('messages.branch_name')}}</label>
        <select id="branchId"  name="branch_id" class="select2 form-control"  >
            <optgroup label="{{__('messages.category_name')}}">
                @foreach($branches as $branch)
                    <option   @if(isset($purchase->branch_id) && $branch->id == $purchase->branch_id )  value="{{$purchase->branch_id}} " selected @else value="{{$branch->id}}" @endif > {{$branch->$branch_name}} </option>
                @endforeach
            </optgroup>
        </select>
    </div>
</div>
