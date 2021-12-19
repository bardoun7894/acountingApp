@extends('admin.ltr.dashboard')
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
                    <form class="form" method="POST" action="{{url('accountControls/'.$accountControl->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="form-actions top clearfix">
                             Update AccountControl
                        </div>

                        <div class="row justify-content-md-center form-group">
                            <div class="col-md-6">
                                <label for="eventRegInput2">Branch Name</label>

                                <select name="account_head_id" class="select2 form-control"  >
                                    <optgroup label="AccountControl name">
                                        @foreach($accountHead_list as $accountHead)
                                            <option    @if($accountHead->account_head_name==$accountHeade->account_head_name) value="{{$accountHeade->id}}"  selected @else value="{{$accountHead->id}}" @endif> {{   $accountHead->account_head_name}} </option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                        </div>

                        <div class="row justify-content-md-center">
                            <div class="col-md-6">
                                <div class="form-body">

                                    <div class="row">
                                        <div class="form-group col-12 mb-2">
                                            <label for="eventRegInput2">AccountControl Name</label>
                                            <input type="text"   class="form-control" placeholder="AccountControl name" name="account_control_name" value="{{$accountControl->account_control_name}}">
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
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
