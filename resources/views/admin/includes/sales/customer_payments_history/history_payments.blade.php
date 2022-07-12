@extends('admin.dashboard')
@section('content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{ __('messages.history_payments') }}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/redirect') }}">{{ __('messages.home') }}</a>
                            </li>
                            <li class="breadcrumb-item active"><a>{{ __('messages.history_payments') }}</a>
                            </li>

                        </ol>
                    </div>
                </div>
            </div>


        </div>
        <div class="content-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">


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
                <div class="row md-form justify-content-md-center">
                    <div>
                        <label for="start"> {{ __('messages.start_date') }} :</label>
                        <input type="date" id="start_date" name="trip-start" min="2021-07-22" max="2025-12-31"
                            class="form-control datepicker">
                    </div>
                    <div>
                        <label for="end"> {{ __('messages.end_date') }} :</label>
                        <input type="date" id="end_date" name="trip-end" min="2021-07-22" max="2025-12-31">
                    </div>
                    <button id="search_btn_date" class="btn btn-primary">{{ __('messages.search') }}</button>


                </div>


                <div id="history_payments_table" class="card-content d-flex p-2 ">
                    @include('admin.includes.sales.customer_payments_history.history_payments_table')
                </div>
            </div>


        </div>



    </div>






@endsection
