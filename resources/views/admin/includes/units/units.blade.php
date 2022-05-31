@extends('admin.dashboard')
@section('content')
    <div class="row" style="display: flex;justify-content: center; margin: 10px ;">
        <div id="recent-transactions">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('messages.units') }}</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a class="btn btn-sm btn-blue box-shadow-2 round btn-min-width pull-right"
                                    href="{{ url('units/create') }}" target="_self">{{ __('messages.add_unit') }}</a></li>
                        </ul>
                    </div>
                </div>
                @if (session()->has('message'))
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
                    <div class="table-responsive d-flex p-2">
                        <table id="datatableBootstrap" class="table table-striped table-bordered table-sm ">

                            <thead>
                                <tr>
                                    <th class="border-top-0">#</th>

                                    <th class="border-top-0">{{ __('messages.unit_name') }}</th>
                                    {{-- <th class="border-top-0">arabic FullName</th> --}}

                                    <th class="border-top-0">{{ __('messages.edit') }}</th>
                                    <th class="border-top-0">{{ __('messages.delete') }}</th>
                                </tr>
                            </thead>
                            <tbody id="-unitsdynamicRow">
                                @foreach ($units as $unit)
                                    <tr>


                                        <td class="text-truncate"> {{ $unit->id }}</td>
                                        {{-- <td class="text-truncate">  @if ($unit->user_type_id == 1) admin @else Branch  @endif       </td> --}}
                                        <td class="text-truncate"> {{ $unit->$unit_name }}</td>
                                        {{-- <td class="text-truncate"> {{$unit->full_name_ar}}</td> --}}

                                        <td class="text-truncate"> <a href="{{ url('units/' . $unit->id . '/edit') }}"><i
                                                    class="la la-edit" style="color: green;font-size: 25px"></i></a>
                                        </td>
                                        <td>
                                            <a class="confirmDelete" record="Unit" recordId="{{ $unit->id }}"> <i
                                                    class="la la-trash" style="color: red;font-size: 25px"></i>
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
