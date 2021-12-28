@extends('admin.dashboard')
@section('content')
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{__("messages.create_user")}}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/redirect')}}">{{__("messages.home")}}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{url('/users')}}">{{__("messages.users")}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{__("messages.add_user")}}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            {{--            setting of page--}}
            <div class="content-header-right col-md-6 col-12">
                <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                    <button class="btn btn-info round dropdown-toggle dropdown-menu-right box-shadow-2 px-2 mb-1" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ft-settings icon-left"></i> Settings</button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="{{url('/getuserInvoice')}}">user Invoice</a>
                        {{--                        <a class="dropdown-item" href="component-buttons-extended.html">Buttons</a>--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            {{--         this is content card--}}
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

                    <form class="form" method="POST" action="{{url('users')}}">
                        @csrf
                        <div class="form-actions top clearfix">
                            {{__('messages.add_user')}}
                        </div>

                        <div class="row justify-content-md-center">
                            <div class="col-md-6">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="form-group col-12 mb-2">
                                            <label for="eventRegInput1">  {{__('messages.fullName')}}</label>
                                            <input type="text" id="eventRegInput1" class="form-control" placeholder="{{__('messages.fullName')}}" name="full_name">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-12 mb-2">
                                            <label for="eventRegInput2">{{__('messages.userName')}}</label>
                                            <input type="text" id="eventRegInput2" class="form-control" placeholder="{{__('messages.userName')}}" name="username">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12 mb-2">
                                            <label for="eventRegInput4">{{__('messages.email')}}</label>
                                            <input type="email" id="eventRegInput4" class="form-control" placeholder="{{__('messages.email')}}" name="email">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-12 mb-2">
                                            <label for="eventRegInput5">{{__('messages.phoneNumber')}}</label>
                                            <input type="tel" id="eventRegInput5" class="form-control" name="{{__('messages.phoneNumber')}}" placeholder="contact number">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-12 mb-2">
                                            <label for="eventRegInput5">{{__('messages.password')}}</label>
                                            <input type="password" id="eventRegInput5" class="form-control" name="password" placeholder="{{__('messages.password')}}">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-12 mb-2">
                                            <label>{{__('messages.user_type')}}</label>
                                            <div class="input-group">
                                                <div class="d-inline-block custom-control custom-radio mr-1">
                                                    <input type="radio" name="user_type_id" class="custom-control-input" id="1" value="1">
                                                    <label class="custom-control-label" for="1">{{__('messages.admin')}}</label>
                                                </div>
                                                <div class="d-inline-block custom-control custom-radio">
                                                    <input type="radio" name="user_type_id" class="custom-control-input" id="2" value="2">
                                                    <label class="custom-control-label" for="2">{{__('messages.user')}}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions clearfix">
                            <div class="buttons-group float-right mb-1">
                                <button type="submit"  class="btn btn-primary mr-1">
                                    <i class="la la-check-square-o"></i> Save
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
        </div>
    </div>
@endsection
