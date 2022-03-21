@extends('admin.dashboard')
@section('content')
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
            <div class="card-content collapse show">
                <div class="card-body">
                    <form class="form" method="POST" action="{{url('/'.$lang.'/stores/'.$store->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="form-actions top clearfix">

                            {{__('messages.update_store')}}
                        </div>

                        <div class="row justify-content-md-center form-group">
                            <div class="col-md-6">
                                <label for="eventRegInput2">{{__('messages.branch_name')}}</label>
                                <select id="branchId"  name="branch_id" class="select2 form-control"  >
                                    <optgroup label="{{__('messages.branch_name')}}">
                                        @foreach($branch_list as $branch)
                                            <option    @if($branch->id==$store->branch_id) value="{{$store->branch_id}}"  selected @else value="{{$branch->id}}" @endif> {{$branch->$branch_name}} </option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                        </div>


                        <div class="row justify-content-md-center">
                            <div class="col-md-6">
                                <div class="form-body">

                                    <div class="row">
                                        <div class="form-group col-12 mb-2">
                                            <label for="eventRegInput2">{{__('messages.store_name')}}</label>
                                            <input type="text"   class="form-control" placeholder="{{__('messages.store_name')}}" name="{{$store_name}}" value="{{$store->$store_name}}">
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="form-actions clearfix">
                            <div class="buttons-group float-right mb-1">
                                <button type="submit"  class="btn btn-primary mr-1">
                                    <i class="la la-check-square-o"></i> Update
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
