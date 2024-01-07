@extends('admin.dashboard')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{ __('messages.sale_payment') }}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/redirect') }}">{{ __('messages.home') }}</a>
                            </li>
                            <li class="breadcrumb-item active"><a>{{ __('messages.sales_invoice_payment') }}</a>
                            </li>

                        </ol>
                    </div>
                </div>
            </div>

        </div>
        <div class="content-body">
           <x-alert type="danger" :errors="$errors" />

            <div class="card">
                <div class="card-body">
                    <h6 class="breadcrumb-item">{{ __('messages.enter_payment_details') }}</h6>
                    <form method="POST"
                        action="{{ url(\App\Models\Translation::getLang() . '/' . 'pay_sale_amount/' . $sale_invoice->id) }}">
                        @csrf
                        <div class="row p-1">
                            <div class="col-md-4">
                                <label for="total_amount">{{ __('messages.previous_remaining_amount') }}</label>
                                <input type="text" id="total_amount" name="total_amount" value="{{ $remaining_amount }}"
                                    readonly required class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="total_amount">{{ __('messages.payment_amount') }}</label>
                                <input type="text" id="payment_amount" name="payment_amount" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="total_amount">{{ __('messages.current_remaining_amount') }}</label>
                                <input type="text" id="remaining_amount" readonly class="form-control" required>
                            </div>

                        </div>
                        <br>
                        <hr>
                        <input type="submit" value="submit payment" class="btn btn-success float-right mr-2 ">
                    </form>
                </div>
            </div>

            <div class="card">



                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif



                <div id="allPurchase_table" class="card-content d-flex p-2 ">

                    @include('admin.includes.sales.paid_sales.paid_amount_table')
                </div>
            </div>


        </div>



    </div>






@endsection
