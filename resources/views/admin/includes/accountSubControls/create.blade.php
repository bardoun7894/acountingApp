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

                    <form class="form" method="POST" action="{{url('/'.$lang.'/accountSubControls')}}">
                        @csrf

                        <div class="form-actions top clearfix">
                         {{__('messages.add_account_sub_control')}}
                        </div>

                        @include('admin.includes.accountHeads.accountHead_table')


                        <div id="appendAccountControlLevel">
                            @include('admin.includes.accountControls.accountControl_table')
                        </div>

{{--                        <div id="appendAccountSubControlLevel">--}}
{{--                            @include('admin.includes.accountSubControls.accountSubControl_table')--}}
{{--                        </div>--}}


                        <div class="row justify-content-md-center">
                            <div class="col-md-6">
                                    <div class="row">
                                        <div class="form-group col-12 mb-2">
                                            <label for="eventRegInput2">{{__('messages.account_sub_control_name')}}</label>
                                            <input type="text" id="eventRegInput2" class="form-control" placeholder="{{__('messages.account_sub_control_name')}}" name="{{$account_sub_control_name}}">
                                        </div>
                                    </div>
                                </div>
                            </div>

              {{--         this account sub control id  for update   --}}
                        <input id="accountSubControlId" value="{{null}}" hidden>

                        <div class="form-actions clearfix">
                            <div class="buttons-group float-right mb-1">
                                <button type="submit"  class="btn btn-primary mr-1">
                                    <i class="la la-check-square-o"></i> {{__('messages.save')}}
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
