@extends('admin.dashboard')
@section('content')

<div class="row" style="display: flex;justify-content: center; margin: 10px ;"  >
    <div id="recent-transactions"  >
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{__('messages.stores')}}</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a class="btn btn-sm btn-blue box-shadow-2 round btn-min-width pull-right" href="{{url('stores/create')}}" target="_self">{{__('messages.add_store')}}</a></li>
                    </ul>
                </div>
            </div>
      @if(session()->has('message'))
      @switch($lang=='en'?explode(' ',session()->get('message'))[2]:explode(' ',session()->get('message'))[1])
                  @case( 'deleted'||'حذف')
                      <div class="alert alert-danger">
                        {{ session()->get('message') }}
                      </div>
                    @break
                @case('updated'||'تعديل')
                <div class="alert alert-secondary">
                    {{ session()->get('message') }}
                </div>
                    @break
                @case('added'||'اضافة')
                    <div class="alert alert-primary">
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
                            <th class="border-top-0">{{__('messages.store_name')}}</th>
                            <th class="border-top-0">{{__('messages.branch_name')}}</th>
                            <th class="border-top-0">{{__('messages.edit')}}</th>
                            <th class="border-top-0">{{__('messages.delete')}}</th>
                        </tr>
                        </thead>

                        <tbody>
                @foreach($stores as $store)
                    <tr>

                            <td class="text-truncate"> {{$store->id}}</td>
{{--                     <td class="text-truncate">  @if($store->user_type_id==1 ) admin @else Category  @endif       </td>--}}
                            <td class="text-truncate"> {{$store->$store_name}}</td>

                            <td class="text-truncate"> {{$store->branch->$branch_name}}</td>
{{--                    <td class="text-truncate"> {{$store->full_name_ar}}</td>--}}


                            <td class="text-truncate">   <a href="{{url('stores/'.$store->id.'/edit')}}"><i class="la la-edit" style="color: green;font-size: 25px"></i></a> </td>
                        <td>
                            <a  class="confirmDelete"  record="Store"  recordId="{{$store->id}}">  <i class="la la-trash" style="color: red;font-size: 25px"></i>
                            </a>
                        </td>
                           </tbody>

                        </tr>
                     @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
