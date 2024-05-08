@if (session()->has('message'))
@switch(session()->get('message'))
    @case(__('messages.data_removed'))
        <div class="alert alert-danger">
            {{ session()->get('message') }}
        </div>
    @break

    @case(__('messages.data_updated'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @break

    @case (__('messages.data_added'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @break

    @default
@endswitch
@endif
