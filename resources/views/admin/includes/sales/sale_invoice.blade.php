@extends('admin.dashboard')
@section('content')
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">Invoice</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Sales</a>
                            </li>
                            <li class="breadcrumb-item active">Sale Invoice </li>
                        </ol>
                    </div>
                </div>
            </div>
            {{-- <div class="content-header-right col-md-6 col-12"> --}}
            {{-- <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown"> --}}
            {{-- <button class="btn btn-info round dropdown-toggle dropdown-menu-right box-shadow-2 px-2 mb-1" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ft-settings icon-left"></i> Settings</button> --}}
            {{-- <div class="dropdown-menu" aria-labelledby="btnGroupDrop1"><a class="dropdown-item" href="card-bootstrap.html">Cards</a><a class="dropdown-item" href="component-buttons-extended.html">Buttons</a></div> --}}
            {{-- </div> --}}
            {{-- </div> --}}
            <div class="content-body">
                <section class="card">
                    <div id="invoice-template" class="card-body p-4">
                        <!-- Invoice Company Details -->
                        <div id="invoice-company-details" class="row">
                            <div class="col-sm-6 col-12 text-center text-sm-left">
                                <div class="media row">
                                    <div class="col-12 col-sm-3 col-xl-2">
                                        <img src="{{ asset('admin/app-assets/images/logo/logo-80x80.png') }}"
                                            alt="company logo" class="mb-1 mb-sm-0" />
                                    </div>
                                    <div class="col-12 col-sm-9 col-xl-10">
                                        <div class="media-body">
                                            {{-- facture --}}
                                            <ul class="ml-2 px-0 list-unstyled">
                                                <li class="text-bold-800">Company Name</li>
                                                <li>4025 Oak Avenue,</li>
                                                <li>Melbourne,</li>
                                                <li>Florida 32940,</li>
                                                <li>USA</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12 text-center text-sm-right">
                                <h2>INVOICE</h2>
                                <p class="pb-sm-3">#{{ $customer_invoice->invoice_no }}</p>
                                {{-- <ul class="px-0 list-unstyled"> --}}
                                {{-- <li>Balance Due</li> --}}
                                {{-- <li class="lead text-bold-800">$12,000.00</li> --}}
                                {{-- </ul> --}}
                            </div>
                        </div>
                        <!-- Invoice Company Details -->

                        <!-- Invoice Customer Details -->
                        <div id="invoice-customer-details" class="row pt-2">
                            <div class="col-12 text-center text-sm-left">
                                <p class="text-muted">Bill To</p>
                            </div>
                            <div class="col-sm-6 col-12 text-center text-sm-left">
                                <ul class="px-0 list-unstyled">
                                    <li class="text-bold-800">M.{{ $customer->$customer_name }}</li>
                                    <li>{{ $customer->$address }}</li>
                                    <li>{{ $customer->email }}</li>
                                    <li>{{ $customer->phone }}</li>
                                </ul>
                            </div>

                            <div class="col-sm-6 col-12 text-center text-sm-right">
                                <p><span class="text-muted">Invoice Date :</span> {{ now() }}</p>
                                <p><span class="text-muted">Terms :</span> Due on Receipt</p>
                                <p><span class="text-muted">Due Date :</span> {{ $customer_invoice->invoice_date }}
                                </p>
                            </div>
                        </div>
                        <!-- Invoice Customer Details -->

                        <!-- Invoice Items Details -->
                        <div id="invoice-items-details" class="pt-2">
                            <div class="table-responsive col-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="border-right-2"> </th>
                                            <th class="text-right">#</th>
                                            <th class="text-right">{{ __('messages.product_name ') }}</th>
                                            <th class="text-right">{{ __('messages.quantity') }}</th>
                                            <th class="text-right">{{ __('messages.unit_price') }}</th>
                                            <th class="text-right">{{ __('messages.item_cost') }}</th>
                                            <th class="text-left"> </th>
                                            <th class="text-left"> </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customer_invoice_details as $customer_invoice_detail)
                                            <tr>
                                                <td class="text-left"> </td>

                                                <td class="text-truncate"> {{ $customer_invoice_detail->id }}</td>
                                                <td class="text-truncate">
                                                    {{ $customer_invoice_detail->stock->$product_name }} </td>
                                                <td class="text-truncate"> {{ $customer_invoice_detail->sale_quantity }}
                                                </td>
                                                <td class="text-truncate">
                                                    {{ $customer_invoice_detail->sale_unit_price }}
                                                </td>
                                                <td class="text-truncate">
                                                    {{ $customer_invoice_detail->sale_unit_price * $customer_invoice_detail->sale_quantity }}
                                                </td>
                                                <td class="text-left"> </td>
                                                <td class="text-left"> </td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                            <div class="row">
                                <div class="col-sm-7 col-12 "></div>
                                <div class="col-sm-5 col-12">
                                    <p class="lead">Total due</p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Sub Total</td>
                                                    <td class="text-right">${{ $customer_invoice->sub_total_amount }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>TAX ({{ $customer_invoice->tax }}%)</td>
                                                    <td class="text-right">
                                                        {{ ($customer_invoice->tax * $customer_invoice->sub_total_amount) / 100 }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Discount ({{ $customer_invoice->discount }}%)</td>
                                                    <td class="text-right">
                                                        {{ ($customer_invoice->discount * $customer_invoice->sub_total_amount) / 100 }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold-800">Total</td>
                                                    <td class="text-bold-800 text-right">
                                                        ${{ $customer_invoice->total_amount }}</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    {{-- <div class="text-center"> --}}
                                    {{-- <p class="mb-0 mt-1">Authorized person</p> --}}
                                    {{-- <img src="../../../app-assets/images/pages/signature-scan.png" alt="signature" class="height-100" /> --}}
                                    {{-- <h6>Amanda Orton</h6> --}}
                                    {{-- <p class="text-muted">Managing Director</p> --}}
                                    {{-- </div> --}}
                                </div>
                            </div>
                        </div>

                        <!-- Invoice Footer -->
                        <div id="invoice-footer">
                            <div class="row">
                                <div class="col-sm-7 col-12 text-center text-sm-left">
                                    <h6>Terms & Condition</h6>
                                    <p>Test pilot isn't always the healthiest business.</p>
                                </div>
                                <div class="col-sm-5 col-12 text-center">
                                    <button type="button" class="btn btn-info btn-print btn-lg my-1" id="btnPrintInvoice"><i
                                            class="la la-paper-plane-o mr-50"></i>
                                        {{ __('messages.print_invoice') }}</button>
                                </div>
                            </div>
                        </div>
                        <!-- Invoice Footer -->

                    </div>
                </section>
            </div>
        </div>


        <!-- END: Content-->
    @endsection
