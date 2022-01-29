<div class="row justify-content-md-center form-group">
    <div class="col-md-6">
        <label for="eventRegInput2">{{__('messages.account_control_name')}}</label>
        <select   id="accountControlId" name="account_control_id" class="select2 form-control"  >
            <optgroup label="AccountControl name">
                @if(isset($accountControls))
                    @foreach($accountControls as $accountControl)
                            <option @if(isset($accountControle) && $accountControle->id==$accountControl->id) selected   value="{{$accountControle->id}}" @else value="{{$accountControl->id}}" @endif > {{$accountControl->$account_control_name}} </option>
                        @endforeach
                    @endif
            </optgroup>
        </select>
    </div>
</div>
