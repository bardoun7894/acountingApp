@extends('admin.ltr.dashboard')
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

            <div class="card-content collpase show">
                <div class="card-body">

                    <form class="form" method="POST" action="{{url('categories')}}">
                        @csrf

                        <div class="form-actions top clearfix">
                             Add New Category
                        </div>
                        <div class="row justify-content-md-center form-group">
                            <div class="col-md-6">
                                <label for="eventRegInput2">Branch Name</label>

                                <select name="branch_id" class="select2 form-control"  >
                                    <optgroup label="Category name">
                                        @foreach($branches as $branch)
                                            <option   value="{{$branch->id}} " > {{$branch->branch_name}} </option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-md-6">


                                    <div class="row">
                                        <div class="form-group col-12 mb-2">
                                            <label for="eventRegInput2">Category Name</label>
                                            <input type="text" id="eventRegInput2" class="form-control" placeholder="category name" name="category_name">
                                        </div>
                                    </div>

                                </div>
                            </div>

                        <div class="form-actions clearfix">
                            <div class="buttons-group float-right mb-1">
                                <button type="submit"  class="btn btn-primary mr-1">
                                    <i class="la la-check-square-o"></i> Save
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
