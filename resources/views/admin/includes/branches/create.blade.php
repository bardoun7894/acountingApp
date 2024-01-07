@extends('admin.dashboard')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">

     <x-alert type="danger" :errors="$errors" />

            <div class="card-content collapse show">
                <div class="card-body">

                    <form class="form" method="POST" action="{{url('/'.$lang.'/branches')}}">
                        @csrf
                        <div class="form-actions top clearfix">
                            {{__('messages.add_branch')}}
                        </div>

                        <div class="row justify-content-md-center">
                            <div class="col-md-6">


                                    <div class="row">
                                        <div class="form-group col-12 mb-2">
                                            <label for="eventRegInput2">{{__('messages.branch_name')}}</label>
                                            <input type="text" id="eventRegInput2" class="form-control" placeholder="{{__('messages.branch_name')}}" name="{{$branch_name}}">
                                        </div>
                                    </div>



                                </div>
                            </div>

                        <div class="form-actions clearfix">
                            <div class="buttons-group float-right mb-1">
                                <button type="submit"  class="btn btn-primary mr-1">
                                    <i class="la la-check-square-o"></i>{{__('messages.save')}}
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
