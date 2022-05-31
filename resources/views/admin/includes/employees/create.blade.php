@extends('admin.dashboard')
@section('content')
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{ __('messages.create_employee') }}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/redirect') }}">{{ __('messages.home') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a
                                    href="{{ url('/employees') }}">{{ __('messages.employees') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('messages.add_employee') }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            {{-- setting of page --}}
            <div class="content-header-right col-md-6 col-12">
                <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                    <button class="btn btn-info round dropdown-toggle dropdown-menu-right box-shadow-2 px-2 mb-1"
                        id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"><i class="ft-settings icon-left"></i> Settings</button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="{{ url('/getemployeeInvoice') }}">employee Invoice</a>
                        {{-- <a class="dropdown-item" href="component-buttons-extended.html">Buttons</a> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            {{-- this is content card --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="card-content collpase show">
                            <div class="card-body">

                                <form class="form" method="POST" action="{{ url('/' . $lang . '/employees') }}">
                                    @csrf
                                    <div class="form-actions top clearfix">
                                        {{ __('messages.add_employee') }}
                                    </div>

                                    <div class="row justify-content-md-center">
                                        <div class="col-md-6">
                                            <div class="form-body">


                                                <div class="row">
                                                    <div class="form-group col-12 mb-2">
                                                        <label
                                                            for="eventRegInput2">{{ __('messages.employee_name') }}</label>
                                                        <input type="text" id="eventRegInput2" class="form-control"
                                                            placeholder="{{ __('messages.employee_name') }}"
                                                            name="{{ $employee_name }}">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-12 mb-2">
                                                        <label
                                                            for="eventRegInput2">{{ __('messages.employee_email') }}</label>
                                                        <input type="email" id="eventRegInput2" class="form-control"
                                                            placeholder="{{ __('messages.employee_email') }}"
                                                            name="employee_email">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-12 mb-2">
                                                        <label
                                                            for="eventRegInput2">{{ __('messages.phoneNumber') }}</label>
                                                        <input type="number" id="eventRegInput2" class="form-control"
                                                            placeholder="{{ __('messages.phoneNumber') }}"
                                                            name="employee_contact_number" min="0" length="10">
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-12 mb-2">
                                                        <label
                                                            for="eventRegInput2">{{ __('messages.designation') }}</label>
                                                        <input type="text" id="eventRegInput2" class="form-control"
                                                            placeholder="{{ __('messages.designation') }}"
                                                            name="designation">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-12 mb-2">
                                                        <label for="eventRegInput2">{{ __('messages.cnic') }}</label>
                                                        <input type="text" id="eventRegInput2" class="form-control"
                                                            placeholder="{{ __('messages.cnic') }}" name="cnic">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-12 mb-2">
                                                        <label
                                                            for="eventRegInput2">{{ __('messages.monthly_salary') }}</label>
                                                        <input type="text" id="eventRegInput2" class="form-control"
                                                            placeholder="{{ __('messages.monthly_salary') }}"
                                                            name="monthly_salary">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-12 mb-2">
                                                        <label for="eventRegInput2">{{ __('messages.address') }}</label>
                                                        <input type="text" id="eventRegInput2" class="form-control"
                                                            placeholder="{{ __('messages.address') }}" name="address">
                                                    </div>
                                                </div>

                                                @include(
                                                    'admin.includes.branches.select_branch'
                                                )


                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions clearfix">
                                        <div class="buttons-group float-right mb-1">
                                            <button type="submit" class="btn btn-primary mr-1">
                                                <i class="la la-check-square-o"></i> {{ __('messages.save') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
