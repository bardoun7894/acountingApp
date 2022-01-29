<div class="row justify-content-md-center form-group">
    <div class="col-md-6">
        <label for="eventRegInput2">{{__('messages.account_activity_name')}}</label>
        <select   id="accountActivityId" name="account_activity_id" class="select2 form-control"  >
            <optgroup label="Account Activity name">
                @foreach($accountActivities as $accountActivity)
                    <option @if(isset($accountActivite) && $accountActivite->id==$accountActivity->id) selected   value="{{$accountActivite->id}}" @else value="{{$accountActivity->id}}" @endif > {{$accountActivity->$account_activity_name}} </option>
                @endforeach
            </optgroup>
        </select>
    </div>
</div>
