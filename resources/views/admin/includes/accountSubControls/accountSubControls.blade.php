@extends('admin.dashboard')
@section('content')

<div class="row" style="display: flex;justify-content: center; margin: 10px ;"  >
    <div id="recent-transactions"  >
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{__('messages.accountSubControls')}}</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a class="btn btn-sm btn-blue box-shadow-2 round btn-min-width pull-right" href="{{url('accountSubControls/create')}}" target="_self">{{__('messages.add_account_control')}}</a></li>
                    </ul>
                </div>
            </div>

            @if(session()->has('message'))
               @switch(session()->get('message'))
                  @case('AccountControl Deleted Successfully')
                  <div class="alert alert-danger">
                    {{ session()->get('message') }}
                </div>
                    @break
                @case('AccountControl Updated Successfully')

                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
                    @break
                @case('AccountControl added Successfully')

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
                            <th class="border-top-0">{{__('messages.account_head_name')}}</th>
                            <th class="border-top-0">{{__('messages.account_control_name')}}</th>
                            <th class="border-top-0">{{__('messages.account_sub_control_name')}}</th>
                            <th class="border-top-0">{{__('messages.user')}}</th>
                            <th class="border-top-0">{{__('messages.edit')}}</th>
                            <th class="border-top-0">{{__('messages.delete')}}</th>
                        </tr>
                        </thead>
                        <tbody id="accountSubControls-dynamicRow">
                        @foreach($accountSubControls as $accountSubControl)
                            <tr>
                                <td class="text-truncate"> {{$accountSubControl->id}}</td>
                                <td class="text-truncate"> {{$accountSubControl->accountHead->$account_head_name}}</td>
                                <td class="text-truncate"> {{$accountSubControl->accountControl->$account_control_name}}</td>
                                <td class="text-truncate"> {{$accountSubControl->$account_sub_control_name}}</td>
                                <td class="text-truncate">  @if($accountSubControl->user->user_type_id==1 ) admin @else user  @endif  </td>
                                <td class="text-truncate">   <a href="{{url('accountSubControls/'.$accountSubControl->id.'/edit')}}"><i class="la la-edit" style="color: green;font-size: 25px"></i></a> </td>
                              {{-- <form action="{{url('accountSubControls/'.$accountSubControl->id)}}" method="post">
                                  @csrf
                                  @method('delete')
                                  <td class="text-truncate"> <button type="submit" style="background: transparent;border: none;"><i class="la la-trash" style="color: red;font-size: 25px"></i></button> </td>
                               </form> --}}
                               <td>
                                   <a  class="confirmDelete"  record="AccountSubControl"  recordId="{{$accountSubControl->id}}">  <i class="la la-trash" style="color: red;font-size: 25px"></i>
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


@endsection
