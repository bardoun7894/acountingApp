@extends('admin.dashboard')
@section('content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{__('messages.history_payments')}}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/redirect')}}">{{__("messages.home")}}</a>
                            </li>
                            <li class="breadcrumb-item active"><a >{{__("messages.history_payments")}}</a>
                            </li>

                        </ol>
                    </div>
                </div>
            </div>


        </div>
        <div class="content-body">
            <x-alert type="danger" :errors="$errors" />

            <div class="card" >

            
                <div id="history_payments_table" class="card-content d-flex p-2 ">
                    @include('admin.includes.purchases.supplier_payments_history.history_payments_table')
                </div>
            </div>


        </div>



    </div>






@endsection
