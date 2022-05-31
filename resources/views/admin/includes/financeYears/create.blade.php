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

                        <form class="form" method="POST" action="{{ url('/' . $lang . '/financeYears') }}">
                            @csrf
                            <div class="form-actions top clearfix">
                                {{ __('messages.add_financeYear') }}
                            </div>
                            <div class="row justify-content-md-center">
                                <div class="col-md-6">
                                    <div class="row">
                                        <label for="eventRegInput2">{{ __('messages.financeYear') }}</label>
                                        <div class="form-group col-9 mb-2">
                                            <input type="text" id="eventRegInput2" class="form-control"
                                                placeholder="{{ __('messages.financeYear') }}" name="financial_year">
                                        </div>
                                        <div class="form-check col-3 mb-4" style="margin-top: 10px">
                                            <input class="form-check-input" type="checkbox" name="isActive" value="1"
                                                id="isActive">
                                            <label class="form-check-label" for="isActive">
                                                {{ __('messages.isActive') }}

                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6 mb-2">
                                            <label for="eventRegInput2">{{ __('messages.startDate') }}</label>
                                            <input type="date" id="eventRegInput2" class="form-control"
                                                placeholder="{{ __('messages.startDate') }}" name="startDate">
                                        </div>
                                        <div class="form-group col-6 mb-2">
                                            <label for="eventRegInput2">{{ __('messages.endDate') }}</label>
                                            <input type="date" id="eventRegInput2" class="form-control"
                                                placeholder="{{ __('messages.endDate') }}" name="endDate">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="form-actions clearfix">
                                <div class="buttons-group float-right mb-1">
                                    <button type="submit" class="btn btn-primary mr-1">
                                        <i class="la la-check-square-o"></i>{{ __('messages.save') }}
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
