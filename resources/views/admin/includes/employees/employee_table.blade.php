<div class="table-responsive d-flex p-2">
    <table id="datatableBootstrap" class=" table table-striped table-bordered">
        <thead>
            <tr>
                <th class="border-top-0">#</th>
                <th class="border-top-0">{{ __('messages.employee_name') }}</th>
                <th class="border-top-0">{{ __('messages.phoneNumber') }}</th>
                <th class="border-top-0">{{ __('messages.designation') }}</th>
                <th class="border-top-0">{{ __('messages.email') }}</th>
                <th class="border-top-0">{{ __('messages.branch_name') }}</th>
                <th class="border-top-0">{{ __('messages.company_name') }}</th>
                <th class="border-top-0">{{ __('messages.edit') }}</th>
                <th class="border-top-0">{{ __('messages.delete') }}</th>
            </tr>
        </thead>
        <tbody id="employees-dynamicRow">
            @foreach ($employees as $employee)
                <tr>
                    <td class="text-truncate"> {{ $employee->id }}</td>
                    <td class="text-truncate"> {{ $employee->$employee_name }}</td>
                    <td class="text-truncate"> {{ $employee->employee_contact_number }}</td>
                    <td class="text-truncate"> {{ $employee->designation }} </td>
                    <td class="text-truncate"> {{ $employee->employee_email }}</td>
                    <td class="text-truncate">{{ $employee->branch->$branch_name }} </td>
                    <td class="text-truncate">{{ $employee->company->$company_name }} </td>
                    <td class="text-truncate"> <a href="{{ url('employees/' . $employee->id . '/edit') }}"><i
                                class="la la-edit" style="color: green;font-size: 25px"></i></a> </td>
                    <td>
                        <a class="confirmDelete" record="Employee" recordId="{{ $employee->id }}"> <i
                                class="la la-trash" style="color: red;font-size: 25px"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
