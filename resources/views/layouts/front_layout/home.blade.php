 @extends('layouts.front_layout.layout')
 @section('content')
     {{-- full slider --}}
     @include('layouts.front_layout.includes.banner')
     {{-- end full-slider-box --}}

     {{-- Featured Categories --}}
     <div class="feature-heading">
         <h2>Featured Categories</h2>
     </div>
     @include('layouts.front_layout.includes.featured_categories')

     <!-- new arrival-->
     @include('layouts.front_layout.includes.new_arrival')

     {{-- end new arrival --}}

     {{-- offer --}}
     @include('layouts.front_layout.includes.offer')

     <!-- featured propducts-->
     @include('layouts.front_layout.includes.featured_products')

     {{-- services --}}
     @include('layouts.front_layout.includes.services')
 @endsection
