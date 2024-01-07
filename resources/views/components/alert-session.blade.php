 
    @if(session()->has('message'))
                    @switch(session()->get('message'))
                        @case(__('messages.data_removed'))
                        {{-- <div class="alert alert-danger">
                            {{ session()->get('message') }}
                        </div> --}}
                        <x-alert type="danger" :message="session('message')" />
                      
                        @break
                        @case(__('messages.data_updated'))
                        <x-alert type="success" :message="session('message')" />
                        {{-- <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div> --}}
                        @break
                        @case (__('messages.data_added'))
                        <x-alert type="success" :message="session('message')" />
                        {{-- <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div> --}}
                        @break
                        @default
                    @endswitch
                @endif

 