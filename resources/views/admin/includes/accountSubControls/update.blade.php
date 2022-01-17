@extends('admin.dashboard')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                       @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                       @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-content collpase show">
                <div class="card-body">
                    <form class="form" method="POST" action="{{url('/'.$lang.'/accountSubControls/'.$accountSubControl->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="form-actions top clearfix">
                             Update AccountControl
                        </div>

                        <div class="row justify-content-md-center form-group">
                            <div class="col-md-6">
                                <label for="eventRegInput2">Account Head Name</label>

                                <select   id="accountHeadId" name="account_head_id" class="select2 form-control"  >
                                    <optgroup label="AccountControl name">
                                        @foreach($accountHead_list as $accountHead)
                                            <option   @if($accountHead->$account_head_name==$accountHeade->$account_head_name) value="{{$accountHeade->id}}"  selected @else value="{{$accountHead->id}}" @endif> {{   $accountHead->$account_head_name}} </option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                        </div>


                        <div class="row justify-content-md-center form-group">
                            <div class="col-md-6">
                                <label for="eventRegInput2">{{__('messages.account_control_name')}}</label>
                                <select id="accountControlId" name="account_control_id" class="select2 form-control"  >
                                    <optgroup id="accountControlOptGroup" label="AccountControl name" >
                                    </optgroup>
                                </select>

                            </div>
                        </div>

                        <div class="row justify-content-md-center">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="form-group col-12 mb-2">
                         <label for="eventRegInput2">{{__('messages.account_sub_control_name')}}</label>
                           <input type="text" id="eventRegInput2" class="form-control"
                           placeholder="{{__('messages.account_sub_control_name')}}" name="{{$account_sub_control_name}}" value="{{$accountSubControl->$account_sub_control_name}}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--         this account sub control id  for update   --}}
                        <input id="accountSubControlId" value="{{$accountSubControl->id}}" hidden>

                        <div class="form-actions clearfix">
                            <div class="buttons-group float-right mb-1">
                                <button type="submit"  class="btn btn-primary mr-1">
                                    <i class="la la-check-square-o"></i> Update
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
