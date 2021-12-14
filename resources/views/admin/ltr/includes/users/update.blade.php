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
                    <form class="form" method="POST" action="{{url('users/'.$user->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="form-actions top clearfix">
                             Update User
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-md-6">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="form-group col-12 mb-2">
                                            <label for="eventRegInput1">Full Name</label>
                                            <input type="text"  class="form-control" placeholder="fullname" name="full_name" value="{{ $user->full_name }}" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12 mb-2">
                                            <label for="eventRegInput2">Username</label>
                                            <input type="text"   class="form-control" placeholder="username" name="username" value="{{$user->username}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12 mb-2">
                                            <label for="eventRegInput4">Email</label>
                                            <input type="email"  class="form-control" placeholder="email" name="email" value="{{$user->email}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12 mb-2">
                                            <label for="eventRegInput5">Contact Number</label>
                                            <input type="tel"   class="form-control" name="contact_number" placeholder="contact number" value="{{$user->contact_number}}">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-12 mb-2">
                                            <label for="eventRegInput5">Password</label>
                                            <input type="password"  class="form-control" name="password" placeholder="password"value="{{$user->password}}">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-12 mb-2">
                                            <label>UserType</label>
                                            <div class="input-group">
                                                <div class="d-inline-block custom-control custom-radio mr-1">
                                                    <input type="radio" name="user_type_id" class="custom-control-input" id="1" value="1" @if($user->user_type_id==1) checked @endif >
                                                    <label class="custom-control-label" for="1">Admin</label>
                                                </div>
                                                <div class="d-inline-block custom-control custom-radio">
                                                    <input type="radio" name="user_type_id" class="custom-control-input" id="2" value="2" @if($user->user_type_id==2) checked @endif>
                                                    <label class="custom-control-label" for="2">User</label>
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
