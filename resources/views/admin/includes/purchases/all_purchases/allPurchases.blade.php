@extends('admin.dashboard') @section('content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">
                    {{ __('messages.all_purchases') }}
                </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/redirect') }}">{{ __('messages.home') }}</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a>{{ __('messages.all_purchases') }}</a>
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
                <div id="allPurchase_table" class="table-responsive card-content d-flex p-2">
                    @include(
                        'admin.includes.purchases.all_purchases.all_purchases_table'
                    )
                </div>
            </div>
        </div>
    </div>

@endsection
