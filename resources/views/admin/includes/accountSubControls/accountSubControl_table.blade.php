<div class="row justify-content-md-center form-group">
    <div class="col-md-6">
        <label for="eventRegInput2">{{__('messages.account_control_sub_name')}}</label>
        <select   id="accountSubControlId" name="account_sub_control_id" class="select2 form-control"  >
            <optgroup label="AccountControl name">
                @if(isset($accountSubControls))
                    @foreach($accountSubControls as $accountSubControl)
                        <option   value="{{$accountSubControl->id}}" > {{$accountSubControl->$account_sub_control_name}} </option>
                    @endforeach
                @endif
            </optgroup>
        </select>
    </div>
</div>
