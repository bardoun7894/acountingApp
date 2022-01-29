<div class="row justify-content-md-center form-group">
    <div class="col-md-6">
        <label for="eventRegInput2">{{__('messages.account_head_name')}}</label>
        <select   id="accountHeadId" name="account_head_id" class="select2 form-control"  >
            <optgroup label="AccountControl name">
                @foreach($accountHeads as $accountHead)
                    <option @if(isset($accountHeade) && $accountHeade->id==$accountHead->id) selected   value="{{$accountHeade->id}}" @else value="{{$accountHead->id}}" @endif > {{$accountHead->$account_head_name}} </option>
                @endforeach
            </optgroup>
        </select>
    </div>
</div>
