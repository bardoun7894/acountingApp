@php

use App\Models\User;

@endphp

<div class="table-responsive d-flex p-2">

    <table id="datatableBootstrap" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th class="border-top-0">#</th>
                <th class="border-top-0">{{ __('messages.company_name') }}</th>
                <th class="border-top-0">{{ __('messages.action') }}</th>
                <th class="border-top-0">{{ __('messages.status') }}</th>
                <th class="border-top-0">{{ __('messages.employee_name') }}</th>
                <th class="border-top-0">{{ __('messages.company_logo') }}</th>
                <th class="border-top-0">{{ __('messages.edit') }}</th>
                <th class="border-left-1 ">{{ __('messages.delete') }}</th>
            </tr>
        </thead>
        <tbody id="companies-dynamicRow">
            @foreach ($companies as $company)
                <tr>
                    <td class="text-truncate"> {{ $company->id }}</td>
                    <td class="text-truncate">{{ $company->$company_name }} </td>

                    <td class="text-truncate" style="text-align: center">
                        @if (User::where('company_id', $company->id)->first()->isActive == 0)
                            <button class="approveUserCompany btn-success rounded-pill"
                                user_id="{{ User::where('company_id', $company->id)->first()->id }}"
                                id="user_approve_id_{{ User::where('company_id', $company->id)->first()->id }}">
                                {{ __('messages.approve') }}
                            </button>
                        @else
                            <button class="approveUserCompany btn-danger rounded-pill"
                                user_id="{{ User::where('company_id', $company->id)->first()->id }}"
                                id="user_approve_id_{{ User::where('company_id', $company->id)->first()->id }}">
                                {{ __('messages.reject') }}
                            </button>
                        @endif
                    </td>
                    <td class="text-truncate">
                        <p id="status-user_{{ User::where('company_id', $company->id)->first()->id }}">
                            @if (User::where('company_id', $company->id)->first()->isActive == 1)
                                {{ __('messages.active') }}
                            @else
                                {{ __('messages.inactive') }}
                            @endif
                        </p>
                    </td>
                    @if ($company->employees->count() > 0)
                        @foreach ($company->employees as $employee)
                            <td class="text-truncate">{{ $employee->$employee_name }} </td>
                        @endforeach
                    @else
                        <td class="text-truncate">{{ __('messages.no_employees_for_this_company') }} </td>
                    @endif
                    <td class="text-truncate">{{ $company->company_logo }} </td>

                    <td class="text-truncate">
                        <a href="{{ url('companies/' . $company->id . '/edit') }}"><i class="la la-edit"
                                style="color: green;font-size: 25px"></i></a>
                    </td>

                    <td>
                        <a class="confirmDelete" record="User" recordId="{{ $company->id }}">
                            <i class="la la-trash" style="color: red;font-size: 25px"></i>
                        </a>
                    </td>
                </tr>
            @endforeach

        </tbody>

    </table>
</div>
