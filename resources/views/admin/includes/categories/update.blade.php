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
                <div class="card-content collpase show">
                    <div class="card-body">
                        <form class="form" method="POST"
                            action="{{ url('/' . $lang . '/categories/' . $categoryData->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-actions top clearfix">

                                {{ __('messages.update_category') }}
                            </div>

                            <div id="appendCategoryLevel">
                                @include(
                                    'admin.includes.categories.append_parent_level'
                                )
                            </div>

                            <div class="row justify-content-md-center">
                                <div class="col-md-6">
                                    <div class="form-body">

                                        <div class="row">
                                            <div class="form-group col-12 mb-2">
                                                <label for="eventRegInput2">{{ __('messages.category_name') }}</label>
                                                <input type="text" class="form-control"
                                                    placeholder="{{ __('messages.category_name') }}"
                                                    name="{{ $category_name }}"
                                                    value="{{ $categoryData->$category_name }}">
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <div class="form-actions clearfix">
                                <div class="buttons-group float-right mb-1">
                                    <button type="submit" class="btn btn-primary mr-1">
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
