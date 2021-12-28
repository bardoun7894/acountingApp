@extends('admin.dashboard')
@section('content')

<div class="row" style="display: flex;justify-content: center; margin: 10px ;"  >
    <div id="recent-transactions"  >
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{__('messages.accountControls')}}</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a class="btn btn-sm btn-blue box-shadow-2 round btn-min-width pull-right" href="{{url('accountControls/create')}}" target="_blank">{{__('messages.add_account_control')}}</a></li>
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
            <div class="input-group d-inline-flex p-4" >
                <input type="search" id="search-account-control" class="form-control rounded" placeholder="Search" aria-label="Search" name="search_text"
                       aria-describedby="search-addon" />
                <button type="submit" class="btn btn-outline-primary">{{__('messages.search')}}</button>
            </div>
            <div class="card-content">
                <div class="table-responsive">
                    <table id="dataex-select-initialisation" class=" table table-hover table-l mb-0">
                        <thead>
                        <tr>
                            <th class="border-top-0">#</th>
                            <th class="border-top-0">{{__('messages.account_control_name')}}</th>
                            <th class="border-top-0">{{__('messages.account_head_name')}}</th>
                            <th class="border-top-0">{{__('messages.edit')}}</th>
                            <th class="border-top-0">{{__('messages.delete')}}</th>
                        </tr>
                        </thead>
{{--                        @foreach($accountHeads as $accountHead)--}}
                           <tbody id="accountControls-dynamicRow">

                           @foreach($accountControls as $accountControl)
                               {{--                @foreach($accountControl->accountHead as $accountHead)--}}
{{--                @foreach($accountControl->accountControls as $accountControl)--}}
                           <tr>
                            <td class="text-truncate"> {{$accountControl->id}}</td>
                            <td class="text-truncate"> {{$accountControl->$account_control_name}}</td>
                            <td class="text-truncate"> {{$accountControl->AccountHead->$account_head_name}}</td>
                            <td class="text-truncate">   <a href="{{url('accountControls/'.$accountControl->id.'/edit')}}"><i class="la la-edit" style="color: green;font-size: 25px"></i></a> </td>
{{--                          <form action="{{url('accountControls/'.$accountControl->id)}}" method="post">--}}
{{--                              @csrf--}}
{{--                              @method('delete')--}}
{{--                              <td class="text-truncate"> <button type="submit" style="background: transparent;border: none;"><i class="la la-trash" style="color: red;font-size: 25px"></i></button> </td>--}}
{{--                           </form>--}}
                            <td>
                                <a  class="confirmDelete"  record="AccountControl"  recordId="{{$accountControl->id}}">  <i class="la la-trash" style="color: red;font-size: 25px"></i>
                                </a>
                            </td>
                           </tr>
                           @endforeach
                           </tbody>
{{--                        @endforeach--}}
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
