@extends('admin.dashboard')

@section('content')

<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <div class="content-header row">
        <!-- Content Header Left -->
        <div class="content-header-left col-md-6 col-12 mb-2">
            <!-- Page Title -->
            <h3 class="content-header-title">{{ __('messages.sales') }}</h3>
            <!-- Breadcrumbs -->
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/redirect') }}">{{ __('messages.home') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('messages.sales') }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- Content Header Right -->
        <div class="content-header-right col-md-6 col-12">
            <div class="btn-group float-md-right" role="group">
                <button class="btn btn-info round dropdown-toggle dropdown-menu-right box-shadow-2 px-2 mb-1"
                        id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"><i class="ft-settings icon-left"></i> {{ __('messages.settings') }}
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <a class="dropdown-item" href="{{ url('/getSaleInvoice') }}">{{ __('messages.sale_invoice') }}</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Body -->
    <div class="content-body">
        <!-- Error Handling -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="invoice_number">{{ __('messages.sale_invoice_no') }}</label>
                        <input type="text" id="invoice_number" class="form-control" placeholder="{{ __('messages.enter_invoice_no') }}">
                    </div>
                </div>
                <div class="col-md-6 d-inline-flex">
                    {{-- //center the button --}}
                    <button type="button" class="btn btn-success align-self-center" id="findInvoiceBtn"> {{ __('messages.find') }} </button>
                </div>
            </div>
               <div id="appendSaleReturnLevel">
            </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('js/saleReturns.js') }}"  type="module"></script>
@endpush
