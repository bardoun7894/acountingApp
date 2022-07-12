<ul id="adaptive" >
    @foreach($banners as $banner)
            <li> 
               <div class=" full-slider-box">
                 <img src="{{url('/images/banner_images/'.$banner->image)}}" alt="">
                   <!-- slider-text container-!?-->
                </div> 
               </div> 
            </li> 
    @endforeach
 </ul>