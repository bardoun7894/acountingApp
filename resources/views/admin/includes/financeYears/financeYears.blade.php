@extends('admin.dashboard')
@section('content')

<div class="row" style="display: flex;justify-content: center; margin: 10px ;"  >
    <div id="recent-transactions"  >
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{__('messages.financeYears')}}</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a class="btn btn-sm btn-blue box-shadow-2 round btn-min-width pull-right" href="{{url('financeYears/create')}}" target="_blank">{{__('messages.add_branch')}}</a></li>
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
            <div class="input-group d-inline-flex p-4" >
                <input type="search" id="search-finance-year" class="form-control rounded" placeholder="Search" aria-label="Search" name="search_text"
                       aria-describedby="search-addon" />
                <button type="submit" class="btn btn-outline-primary">{{__('messages.search')}}</button>
            </div>
            <div class="card-content">
                <div class="table-responsive">
                    <table id="dataex-select-initialisation" class=" table table-hover table-l mb-0">

                        <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">{{__('messages.finance_year')}}</th>
                                <th class="border-top-0">startDate</th>
                                <th class="border-top-0">endDate</th>
                                <th class="border-top-0">isActive</th>
                                <th class="border-top-0">{{__('messages.edit')}}</th>
                                <th class="border-top-0">{{__('messages.delete')}}</th>
                            </tr>
                        </thead>
                        @foreach($financeYears as $financeYear)
                           <tbody id="financeYears-dynamicRow">
                            <td class="text-truncate" > {{$financeYear->id}}</td>
                            <td class="text-truncate" > {{$financeYear->financial_year}}</td>
                            <td class="text-truncate" > {{$financeYear->startDate}}</td>
                            <td class="text-truncate" > {{$financeYear->endDate}}</td>
                            <td class="text-truncate" > {{$financeYear->isActive}}</td>
                            <td class="text-truncate" >  <a href="{{url('financeYears/'.$financeYear->id.'/edit')}}"><i class="la la-edit" style="color: green;font-size: 25px"></i></a> </td>
                            <td>
                                <a  class="confirmDelete"  record="FinanceYear"  recordId="{{$financeYear->id}}">  <i class="la la-trash" style="color: red;font-size: 25px"></i>
                                </a>
                            </td>
                           </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
