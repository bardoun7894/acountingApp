<?php
$current_user =\Illuminate\Support\Facades\Auth::user();

?>
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">

    {{--  main menu content --}}

    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li
            {{-- dont forget to add class="active" in <li> tag if you want active menu page open by default --}}
            class="active"
            ><a href="index.html"><i class="la la-home"></i><span class="menu-title" data-i18n="eCommerce Dashboard"> Dashboard</span></a>
            </li>

             {{-- navigation header --}}
            <li class=" navigation-header"><span data-i18n="Ecommerce">Ecommerce</span><i class="la la-ellipsis-h" data-toggle="tooltip" data-placement="right" data-original-title="Account System"></i>
            </li>

           {{-- navigation items --}}

            <li class=" nav-item "><a href="ecommerce-product-shop.html"><i class="la la-th-large"></i><span class="menu-title" data-i18n="Shop">Purchases</span></a>
            </li>
            <li class=" nav-item"><a href="ecommerce-product-detail.html"><i class="la la-list"></i><span class="menu-title" data-i18n="Product Detail">sales</span></a>
            </li>
            <li class=" nav-item"><a href="ecommerce-shopping-cart.html"><i class="la la-shopping-cart"></i><span class="menu-title" data-i18n="Shopping Cart">Stock</span></a>
            </li>
            <li class=" nav-item"><a href="ecommerce-checkout.html"><i class="la la-credit-card"></i><span class="menu-title" data-i18n="Checkout">Reports</span></a>
            </li>
             @if($current_user->user_type_id==1)
                 <li class=" nav-item" ><a href="#"><i class="la la-clipboard" ></i><span class="menu-title" data-i18n="Settings">Settings</span></a>
                <ul class="menu-content">
                    <li><a   @if($current_user->user_type_id==1) class="active menu-item"  @else class="menu-item" @endif  href="{{url('users')}}"><i></i><span data-i18n="Users">Users</span></a>
                    </li>
                    <li><a class="menu-item" href="categories"><i></i><span data-i18n="categories">Categories</span></a>
                    <li><a class="menu-item" href="branches"><i></i><span data-i18n="branches">Branches</span></a>
                    <li><a class="menu-item" href="stocks"><i></i><span data-i18n="stocks">Stocks</span></a>
                    <li><a class="menu-item" href="accountHeads"><i></i><span data-i18n="accountHeads">AccountHeads</span></a>
                    <li><a class="menu-item" href="accountControls"><i></i><span data-i18n="accountControls">AccountControls</span></a>
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
