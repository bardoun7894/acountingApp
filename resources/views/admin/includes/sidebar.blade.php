<?php
$current_user = \Illuminate\Support\Facades\Auth::user();

?>
<div class=" main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">

    {{-- main menu content --}}

    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li {{-- dont forget to add class="active" in <li> tag if you want active menu page open by default --}} class="active"><a href="index.html"><i class="la la-home"></i><span
                        class="menu-title" data-i18n="eCommerce Dashboard"> Dashboard</span></a>
            </li>

            {{-- navigation header --}}
            <li class=" navigation-header"><span data-i18n="Ecommerce">Accounting App</span><i class="la la-ellipsis-h"
                    data-toggle="tooltip" data-placement="right" data-original-title="Account System"></i>
            </li>

            {{-- navigation items --}}


            <li class=" nav-item"><a href="#"><i class="la la-shopping-cart"></i><span class="menu-title"
                        data-i18n="Stock">{{ __('messages.purchases') }}</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ url('allPurchases') }}"><i></i> <span
                                data-i18n="purchases">{{ __('messages.all_purchases') }}</span></a>
                    <li><a class="menu-item" href="{{ url('purchases') }}"><i></i> <span
                                data-i18n="purchases">{{ __('messages.purchase_order') }}</span></a>
                    <li><a class="menu-item" href="{{ url('purchasePaymentPending') }}"><i></i> <span
                                data-i18n="pending_payments">{{ __('messages.pending_payments') }}</span></a>

                </ul>
            </li>

            <li class=" nav-item"><a href="#"><i class="la la-shopping-cart"></i><span class="menu-title"
                        data-i18n="Stock">{{ __('messages.sales') }}</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ url('allSales') }}"><i></i> <span
                                data-i18n="purchases">{{ __('messages.all_sales') }}</span></a>

                                <li><a class="menu-item" href="{{ url('sales') }}"><i></i> <span
                                data-i18n="sales">{{ __('messages.sale_order') }}</span></a>

                    <li><a class="menu-item" href="{{ url('salePaymentPending') }}"><i></i> <span
                                data-i18n="pending_payments">{{ __('messages.pending_payments') }}</span></a>

                </ul>
            </li>

            <li class=" nav-item"><a href="#"><i class="la la-clipboard"></i><span class="menu-title"
                        data-i18n="Stock">{{ __('messages.stocks') }}</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ url('categories') }}"><i></i><span
                                data-i18n="categories">{{ __('messages.categories') }}</span></a>
                    <li><a class="menu-item" href="{{ url('stocks') }}"><i></i> <span
                                data-i18n="products">{{ __('messages.stocks') }}</span></a>
                    <li><a class="menu-item" href="{{ url('suppliers') }}"><i></i> <span
                                data-i18n="products">{{ __('messages.suppliers') }}</span></a>
                    </li>
                    <li><a class="menu-item" href="{{ url('customers') }}"><i></i> <span
                                data-i18n="customers">{{ __('messages.customers') }}</span></a>
                    </li>
                    <li><a class="menu-item" href="{{ url('branches') }}"><i></i><span
                                data-i18n="branches">{{ __('messages.branches') }}</span></a>
                    </li>

                </ul>
            </li>
            <li class=" nav-item"><a href="ecommerce-checkout.html"><i class="la la-credit-card"></i><span
                        class="menu-title" data-i18n="Checkout">Reports</span></a>
            </li>
            @if ($current_user->user_type_id == 1 || $current_user->user_type_id == 3)
                <li class=" nav-item"><a href="#"><i class="la la-clipboard"></i><span class="menu-title"
                            data-i18n="Settings">{{ __('messages.settings') }}</span></a>
                    <ul class="menu-content">
                        <li><a @if ($current_user->user_type_id == 1) class="active menu-item"  @else class="menu-item" @endif
                                href="{{ url($lang . '/users') }}"><i></i><span
                                    data-i18n="Users">{{ __('messages.users') }}</span></a>
                        </li>
                        @if (Auth::user()->user_type_id == 3)
                            <li><a class="menu-item" href="{{ url($lang . '/companies') }}"><i></i><span
                                        data-i18n="Companies">{{ __('messages.companies') }}</span></a>
                            </li>
                        @endif

                        <li><a class="menu-item" href="{{ url($lang . '/employees') }}"><i></i><span
                                    data-i18n="Employees">{{ __('messages.employees') }}</span></a>
                        </li>

                        <li class=" nav-item"><a href="#"><i class="la la-clipboard"></i><span
                                    class="menu-title" data-i18n="Stock">{{ __('messages.accounts') }}</span></a>
                            <ul class="menu-content">
                                <li><a class="menu-item" href="{{ url('accountHeads') }}"><i></i><span
                                            data-i18n="accountHeads">&nbsp; &nbsp;
                                            {{ __('messages.accountHeads') }}</span></a></li>
                                <li><a class="menu-item" href="{{ url('accountSubControls') }}"><i></i><span
                                            data-i18n="accountSubControls">&nbsp;
                                            &nbsp;{{ __('messages.accountSubControls') }}</span></a>
                                </li>
                                <li><a class="menu-item" href="{{ url('accountControls') }}"><i></i><span
                                            data-i18n="accountControls">&nbsp;
                                            &nbsp;{{ __('messages.accountControls') }}</span></a>
                                <li><a class="menu-item" href="{{ url('financeYears') }}"><i></i><span
                                            data-i18n="financeYears">&nbsp;
                                            &nbsp;{{ __('messages.financeYears') }}</span></a>
                                </li>
                                <li><a class="menu-item" href="{{ url('accountActivities') }}"><i></i><span
                                            data-i18n="accountActivities">&nbsp; &nbsp;
                                            {{ __('messages.accountActivities') }}</span></a></li>

                            </ul>
                        <li><a class="menu-item" href="{{ url('stores') }}"><i></i><span
                                    data-i18n="stores">{{ __('messages.stores') }}</span></a>
                        </li>

                        <li><a class="menu-item" href="{{ url('payment_types') }}"><i></i><span
                                    data-i18n="payment_types">{{ __('messages.payment_types') }}</span></a>
                        </li>

                        <li><a class="menu-item" href="{{ url('units') }}"><i></i><span
                                    data-i18n="units">{{ __('messages.units') }}</span></a>
                        </li>
                        <li><a class="menu-item" href="invoice-template.html"><i></i><span
                                    data-i18n="Invoice Template">Invoice Template</span></a>
                        </li>
                        <li><a class="menu-item" href="invoice-list.html"><i></i><span
                                    data-i18n="Invoice List">Invoice List</span></a>
                        </li>
                    </ul>
                </li>
            @endif

            {{-- this has menu content --}}
            <li class=" nav-item"><a href="#"><i class="la la-clipboard"></i><span class="menu-title"
                        data-i18n="Invoice">Invoice</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="invoice-summary.html"><i></i><span
                                data-i18n="Invoice Summary">Invoice Summary</span></a>
                    </li>
                    <li><a class="menu-item" href="invoice-template.html"><i></i><span
                                data-i18n="Invoice Template">Invoice Template</span></a>
                    </li>
                    <li><a class="menu-item" href="invoice-list.html"><i></i><span data-i18n="Invoice List">Invoice
                                List</span></a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</div>
