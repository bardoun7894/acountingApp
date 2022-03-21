@extends('admin.dashboard')
@section('content')

<div class="row" style="display: flex;justify-content: center; margin: 10px ;"  >
    <div id="recent-transactions"  >
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{__("messages.accountHeads")}}</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a class="btn btn-sm btn-blue box-shadow-2 round btn-min-width pull-right" href="{{url('accountHeads/create')}}" target="_self">{{__("messages.add_account_head")}}</a></li>
                    </ul>
                </div>
            </div>
{{--           {{__('messages.data_deleted')}}--}}
{{--           {{ \Illuminate\Support\Facades\Lang::get('messages.deleted')  }}--}}
            @if(session()->has('message'))
                @switch(session()->get('message'))
                    @case(__('messages.data_removed'))
                    <div class="alert alert-danger">
                        {{ session()->get('message') }}
                    </div>
                    @break
                    @case(__('messages.data_updated'))

                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>

                    @break
                    @case (__('messages.data_added'))

                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @break
                    @default

                @endswitch

            @endif
            <div class="card-content">
                <div   class="card-content d-flex p-2">
                    <table id="datatableBootstrap"   class="table table-striped table-bordered table-sm " >

                    <thead>
                        <tr>
                            <th class="border-top-0">#</th>
                            <th class="border-top-0">{{__("messages.account_head_name")}}</th>
                            <th class="border-top-0">{{__("messages.user_type")}}</th>
                            <th class="border-top-0">{{__("messages.edit")}}</th>
                            <th class="border-top-0">{{__("messages.delete")}}</th>
                        </tr>
                        </thead>
                        @foreach($users as $user)


                            <tbody id="accountHeads-dynamicRow" >
                            @foreach($user->accountHeads as $accountHead)
                                <tr>
                            <td class="text-truncate"> {{$accountHead->id}}</td>
{{--                        <td class="text-truncate">  @if($accountHead->user_type_id==1 ) admin @else AccountHead  @endif       </td>--}}
                            <td class="text-truncate"> {{$accountHead->$account_head_name}}</td>
                            <td class="text-truncate"> {{$user->user_type->$user_type }} </td>
                            <td class="text-truncate">   <a href="{{url('accountHeads/'.$accountHead->id.'/edit')}}"><i class="la la-edit" style="color: green;font-size: 25px"></i></a> </td>
                            <td>
                                <a  class="confirmDelete"  record="AccountHead"  recordId="{{$accountHead->id}}">  <i class="la la-trash" style="color: red;font-size: 25px"></i>
                                </a>
                            </td>
                            </tr>
                            @endforeach
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
