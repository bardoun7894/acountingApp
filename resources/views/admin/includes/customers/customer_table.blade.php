<div class="card-content d-flex p-2">
    <table id="datatableBootstrap" class="table table-striped table-bordered m-2"  >
        <thead>
        <tr>
            <th class="border-top-0">#</th>
            <th class="border-top-0">{{__('messages.customerName')}}</th>
            <th class="border-top-0">{{__('messages.phoneNumber')}}</th>
            <th class="border-top-0">{{__('messages.address')}}</th>
            <th class="border-top-0">{{__('messages.description')}}</th>
            <th class="border-top-0">{{__('messages.area')}}</th>
            <th class="border-top-0">{{__('messages.edit')}}</th>
            <th class="border-top-0">{{__('messages.delete')}}</th>
        </tr>
        </thead>
        <tbody id="customers-dynamicRow">
        @foreach($customers as $customer)
            <tr>
                <td class="text-truncate"> {{$customer->id }}</td>
                <td class="text-truncate">{{$customer->$customer_name}}   </td>
                <td class="text-truncate"> {{$customer->contact_number}}</td>
                <td class="text-truncate"> {{$customer->$address}}</td>
                <td class="text-truncate"> {{$customer->$description}}</td>
                <td class="text-truncate"> {{$customer->area}}</td>
                <td class="text-truncate">   <a href="{{url('customers/'.$customer->id.'/edit')}}"><i class="la la-edit" style="color: green;font-size: 25px"></i></a> </td>
                <td>
      <a class="confirmDelete"  record="Customer"  recordId="{{$customer->id}}">
          <i class="la la-trash" style="color: red;font-size: 25px"></i></a></td>

            </tr>
        @endforeach
        </tbody>

    </table>

</div>
