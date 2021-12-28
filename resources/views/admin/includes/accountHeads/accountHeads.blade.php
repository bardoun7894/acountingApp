@extends('admin.dashboard')
@section('content')

<div class="row" style="display: flex;justify-content: center; margin: 10px ;"  >
    <div id="recent-transactions"  >
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">accountHeads</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a class="btn btn-sm btn-blue box-shadow-2 round btn-min-width pull-right" href="{{url('accountHeads/create')}}" target="_blank">Add AccountHead</a></li>
                    </ul>
                </div>
            </div>
{{--           {{__('messages.accountHead_deleted')}}--}}
{{--           {{ \Illuminate\Support\Facades\Lang::get('messages.deleted')  }}--}}
            @if(session()->has('message'))
               @switch(session()->get('message'))
                  @case(__('messages.accountHead_deleted'))
                  <div class="alert alert-danger">
                    {{ session()->get('message') }}
                  </div>
                    @break
                @case('AccountHead Updated Successfully')

                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
                    @break
                @case('AccountHead added Successfully')

                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                        @break
                @default

            @endswitch

            @endif
            <div class="card-content">
                <div class="table-responsive">
                    <table id="dataex-select-initialisation" class=" table table-hover table-l mb-0">

                        <thead>
                        <tr>
                            <th class="border-top-0">#</th>

                            <th class="border-top-0">AccountHead Name</th>
                            <th class="border-top-0">user type</th>
                            <th class="border-top-0">Edit</th>
                            <th class="border-top-0">delete</th>
                        </tr>
                        </thead>
                        @foreach($users as $user)

                        @foreach($user->accountHeads as $accountHead)
                           <tbody>

                            <td class="text-truncate"> {{$accountHead->id}}</td>
{{--                            <td class="text-truncate">  @if($accountHead->user_type_id==1 ) admin @else AccountHead  @endif       </td>--}}
                            <td class="text-truncate"> {{$accountHead->$account_head_name}}</td>

                          <td class="text-truncate"> {{$user->user_type->$user_type }} </td>

                            <td class="text-truncate">   <a href="{{url('accountHeads/'.$accountHead->id.'/edit')}}"><i class="la la-edit" style="color: green;font-size: 25px"></i></a> </td>
                          <form action="{{url('accountHeads/'.$accountHead->id)}}" method="post">
                              @csrf
                              @method('delete')
                              <td class="text-truncate"> <button type="submit" style="background: transparent;border: none;"><i class="la la-trash" style="color: red;font-size: 25px"></i></button> </td>
                           </form>
                           </tbody>
                        @endforeach
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
