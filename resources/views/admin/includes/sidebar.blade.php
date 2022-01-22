<?php
$current_user =\Illuminate\Support\Facades\Auth::user();

?>
<div class=" main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">

    {{--  main menu content --}}

    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li
            {{-- dont forget to add class="active" in <li> tag if you want active menu page open by default --}}
            class="active"
            ><a href="index.html"><i class="la la-home"></i><span class="menu-title" data-i18n="eCommerce Dashboard"> Dashboard</span></a>
            </li>

             {{-- navigation header --}}
            <li class=" navigation-header"><span data-i18n="Ecommerce">Accounting App</span><i class="la la-ellipsis-h" data-toggle="tooltip" data-placement="right" data-original-title="Account System"></i>
            </li>

           {{-- navigation items --}}


            <li class=" nav-item" ><a href="#"><i class="la la-th-large" ></i><span class="menu-title" data-i18n="Stock">{{__('messages.purchases')}}</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{url('purchases')}}"><i></i> <span data-i18n="purchases">{{__('messages.purchases')}}</span></a>

                </ul>
            </li>

            <li class=" nav-item"><a href="ecommerce-product-detail.html"><i class="la la-list"></i><span class="menu-title" data-i18n="Product Detail">{{__('messages.sales')}}</span></a>
            </li>
       <li class=" nav-item" ><a href="#"><i class="la la-clipboard" ></i><span class="menu-title" data-i18n="Stock">{{__('messages.stocks')}}</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{url('categories')}}"><i></i><span data-i18n="categories">{{__('messages.categories')}}</span></a>
                    <li><a class="menu-item" href="{{url('stocks')}}"><i></i> <span data-i18n="products">{{__('messages.stocks')}}</span></a>
                    <li><a class="menu-item" href="{{url('suppliers')}}"><i></i> <span data-i18n="products">{{__('messages.suppliers')}}</span></a>
                    </li>
                    <li><a class="menu-item" href="{{url('customers')}}"><i></i> <span data-i18n="customers">{{__('messages.customers')}}</span></a>
                    </li>
                    <li><a class="menu-item" href="{{url('branches')}}"><i></i><span data-i18n="branches">{{__('messages.branches')}}</span></a>
                    </li>

                </ul>
            </li>
            <li class=" nav-item"><a href="ecommerce-checkout.html"><i class="la la-credit-card"></i><span class="menu-title" data-i18n="Checkout">Reports</span></a>
            </li>
             @if($current_user->user_type_id==1)
                 <li class=" nav-item" ><a href="#"><i class="la la-clipboard" ></i><span class="menu-title" data-i18n="Settings">{{__('messages.settings')}}</span></a>
                <ul class="menu-content">
                    <li><a   @if($current_user->user_type_id==1) class="active menu-item"  @else class="menu-item" @endif  href="{{url($lang.'/users')}}"><i></i><span data-i18n="Users">{{__('messages.users')}}</span></a>
                    </li>

                    <li class=" nav-item" ><a href="#"><i class="la la-clipboard" ></i><span class="menu-title" data-i18n="Stock">{{__('messages.accounts')}}</span></a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="{{url('accountHeads')}}"><i></i><span data-i18n="accountHeads">{{__('messages.accountHeads')}}</span></a>
                            <li><a class="menu-item" href="{{url('accountSubControls')}}"><i></i><span data-i18n="accountSubControls">{{__('messages.accountSubControls')}}</span></a>
                            </li>
                            <li><a class="menu-item" href="{{url('accountControls')}}" ><i></i><span data-i18n="accountControls">{{__('messages.accountControls')}}</span></a>
                            <li><a class="menu-item"href="{{url('financeYears')}}" ><i></i><span data-i18n="financeYears">{{__('messages.financeYears')}}</span></a>
                            </li>

                        </ul>
                    <li><a class="menu-item"href="{{url('units')}}" ><i></i><span data-i18n="units">{{__('messages.units')}}</span></a>
                    </li>
                    <li><a class="menu-item" href="invoice-template.html"><i></i><span data-i18n="Invoice Template">Invoice Template</span></a>
                    </li>
                    <li><a class="menu-item" href="invoice-list.html"><i></i><span data-i18n="Invoice List">Invoice List</span></a>
                    </li>
                </ul>
            </li>
             @endif

            {{-- this has menu content --}}
            <li class=" nav-item"><a href="#"><i class="la la-clipboard"></i><span class="menu-title" data-i18n="Invoice">Invoice</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="invoice-summary.html"><i></i><span data-i18n="Invoice Summary">Invoice Summary</span></a>
                    </li>
                    <li><a class="menu-item" href="invoice-template.html"><i></i><span data-i18n="Invoice Template">Invoice Template</span></a>
                    </li>
                    <li><a class="menu-item" href="invoice-list.html"><i></i><span data-i18n="Invoice List">Invoice List</span></a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</div>