
<div class="card-content d-flex p-2">

    <table  id="datatableBootstrap"   class=" table table-striped table-bordered">
        <thead>
        <tr>
            <th class="border-top-0">#</th>
            <th class="border-top-0">{{__('messages.role')}}</th>
            <th class="border-top-0">{{__('messages.store_name')}}</th>
            <th class="border-top-0">{{__('messages.branch_name')}}</th>
            <th class="border-top-0">{{__('messages.fullName')}}</th>
            <th class="border-top-0">{{__('messages.userName')}}</th>
            <th class="border-top-0">{{__('messages.email')}}</th>
            <th class="border-top-0">{{__('messages.phoneNumber')}}</th>
            <th class="border-top-0">{{__('messages.edit')}}</th>
            <th class="border-top-0">{{__('messages.delete')}}</th>
        </tr>
        </thead>
        <tbody id="users-dynamicRow">
        @foreach($users as $user)

            <tr>
                <td class="text-truncate"> {{$user->id }}</td>
                <td class="text-truncate">  @if($user->user_type_id==1 ) admin @else user  @endif  </td>
                <td class="text-truncate">{{$user->store->$store_name}}   </td>
                <td class="text-truncate">{{$user->branch->$branch_name}}   </td>
                <td class="text-truncate">{{$user->$full_name}}   </td>
                <td class="text-truncate"> {{$user->username}}</td>
                <td class="text-truncate"> {{$user->email}}</td>
                <td class="text-truncate"> {{$user->contact_number}}</td>
                <td class="text-truncate">   <a href="{{url('users/'.$user->id.'/edit')}}"><i class="la la-edit" style="color: green;font-size: 25px"></i></a> </td>

                <td>
                    <a  class="confirmDelete"  record="User"  recordId="{{$user->id}}">  <i class="la la-trash" style="color: red;font-size: 25px"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>


