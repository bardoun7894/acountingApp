
<?php
$full_name='full_name_'.\App\Models\Translation::getLang();
?>
@extends('admin.dashboard')
@section('content')
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{__("messages.users")}}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">{{__("messages.home")}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{__("messages.users")}}
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
    <div id="recent-transactions"  >
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{__('messages.users')}} </h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a class="btn btn-sm btn-blue box-shadow-2 round btn-min-width pull-right" href="{{url('users/create')}}" target="_blank">{{__('messages.add_user')}}</a></li>
                    </ul>
                </div>
            </div>

            @if(session()->has('message'))
               @switch(session()->get('message'))
                  @case('User Deleted Successfully')
                  <div class="alert alert-danger">
                    {{ session()->get('message') }}
                </div>
                    @break
                @case('User Updated Successfully')

                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
                    @break
                @case('User added Successfully')

                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                        @break
                @default

            @endswitch

            @endif

            <div class="input-group d-inline-flex p-4" >
                <input type="search" id="search-user" class="form-control rounded" placeholder="Search" aria-label="Search" name="search_text"
                       aria-describedby="search-addon" />
                <button  class="btn btn-outline-primary">{{__('messages.search')}}</button>
            </div>

            <div class="card-content">
                <div class="table-responsive">
                    <table id="dataex-select-initialisation" class=" table table-hover table-l mb-0">
                        <thead>
                        <tr>
                            <th class="border-top-0">#</th>
                            <th class="border-top-0">{{__('messages.role')}}</th>
                            <th class="border-top-0">{{__('messages.fullName')}}</th>
                            <th class="border-top-0">{{__('messages.userName')}}</th>
                            <th class="border-top-0">{{__('messages.email')}}</th>
                            <th class="border-top-0">{{__('messages.phoneNumber')}}</th>
                            <th class="border-top-0">{{__('messages.edit')}}</th>
                            <th class="border-top-0">{{__('messages.delete')}}</th>
                        </tr>
                        </thead>
                           <tbody id="users-dynamicRow">
                           @foreach($users as $user)
                               <tr>
                               <td class="text-truncate"> {{$user->id }}</td>
                               <td class="text-truncate">  @if($user->user_type_id==1 ) admin @else user  @endif  </td>
                               <td class="text-truncate">{{$user->$full_name}}   </td>
                               <td class="text-truncate"> {{$user->username}}</td>
                               <td class="text-truncate"> {{$user->email}}</td>
                               <td class="text-truncate"> {{$user->contact_number}}</td>
                               <td class="text-truncate">   <a href="{{url('users/'.$user->id.'/edit')}}"><i class="la la-edit" style="color: green;font-size: 25px"></i></a> </td>

                               <td>
                                   <a  class="confirmDelete"  record="User"  recordId="{{$user->id}}">  <i class="la la-trash" style="color: red;font-size: 25px"></i>
                                   </a>
                               </td>
                           </tr>

                           @endforeach
                           </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>
@endsection
