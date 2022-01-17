@extends('admin.dashboard')
@section('content')

<div class="row" style="display: flex;justify-content: center; margin: 10px ;"  >
    <div id="recent-transactions"  >
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{__('messages.units')}}</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a class="btn btn-sm btn-blue box-shadow-2 round btn-min-width pull-right" href="{{url('units/create')}}" target="_blank">{{__('messages.add_unit')}}</a></li>
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
                <div class="table-responsive">
                    <table id="dataex-select-initialisation" class=" table table-hover table-l mb-0">

                        <thead>
                        <tr>
                            <th class="border-top-0">#</th>

                            <th class="border-top-0">{{__('messages.unit_name')}}</th>
{{--                            <th class="border-top-0">arabic FullName</th>--}}

                            <th class="border-top-0">{{__('messages.edit')}}</th>
                            <th class="border-top-0">{{__('messages.delete')}}</th>
                        </tr>
                        </thead>
                        @foreach($units as $unit)
                           <tbody>

                            <td class="text-truncate"> {{$unit->id}}</td>
{{--                            <td class="text-truncate">  @if($unit->user_type_id==1 ) admin @else Branch  @endif       </td>--}}
                            <td class="text-truncate"> {{$unit->$unit_name}}</td>
{{--                            <td class="text-truncate"> {{$unit->full_name_ar}}</td>--}}

                            <td class="text-truncate">   <a href="{{url('units/'.$unit->id.'/edit')}}"><i class="la la-edit" style="color: green;font-size: 25px"></i></a> </td>
                          <form action="{{url('units/'.$unit->id)}}" method="post">
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
