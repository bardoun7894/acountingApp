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
                    <form class="form" method="POST" action="{{url('/'.$lang.'/accountSettings/'.$accountSetting->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="form-actions top clearfix">
                             Update AccountControl
                        </div>

                        @include('admin.includes.accountHeads.accountHead_table')

                        <div id="appendAccountControlLevel">
                            @include('admin.includes.accountControls.accountControl_table')
                        </div>

                        <div id="appendAccountSubControlLevel">
                            @include('admin.includes.accountSubControls.accountSubControl_table')
                        </div>
                        <div id="appendAccountActivityLevel">
                            @include('admin.includes.accountActivities.accountActivity_table')
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
