@extends('admin.dashboard')
@section('content')

<div class="row" style="display: flex;justify-content: center; margin: 10px ;"  >
    <div id="recent-transactions"  >
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{__('messages.branches')}}</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a class="btn btn-sm btn-blue box-shadow-2 round btn-min-width pull-right" href="{{url('branches/create')}}" target="_self">{{__('messages.add_branch')}}</a></li>
                    </ul>
                </div>
            </div>

            @if(session()->has('message'))
               @switch(session()->get('message'))
                  @case('Branch Deleted Successfully')
                  <div class="alert alert-danger">
                    {{ session()->get('message') }}
                </div>
                    @break
                @case('Branch Updated Successfully')

                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
                    @break
                @case('Branch added Successfully')

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

                            <th class="border-top-0">{{__('messages.branch_name')}}</th>
{{--                            <th class="border-top-0">arabic FullName</th>--}}

                            <th class="border-top-0">{{__('messages.edit')}}</th>
                            <th class="border-top-0">{{__('messages.delete')}}</th>
                        </tr>
                        </thead>
                        @foreach($branches as $branch)
                           <tbody>

                            <td class="text-truncate"> {{$branch->id}}</td>
{{--                            <td class="text-truncate">  @if($branch->user_type_id==1 ) admin @else Branch  @endif       </td>--}}
                            <td class="text-truncate"> {{$branch->$branch_name}}</td>
{{--                            <td class="text-truncate"> {{$branch->full_name_ar}}</td>--}}

                            <td class="text-truncate">   <a href="{{url('branches/'.$branch->id.'/edit')}}"><i class="la la-edit" style="color: green;font-size: 25px"></i></a> </td>
                          <form action="{{url('branches/'.$branch->id)}}" method="post">
                              @csrf
                              @method('delete')
                              <td class="text-truncate"> <button type="submit" style="background: transparent;border: none;"><i class="la la-trash" style="color: red;font-size: 25px"></i></button> </td>
                           </form>
                           </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
