
<section>

<ul id="autoWidth"  >
   @for ($i = 1; $i <= 6; $i++)
    <li class="item">
      <div class="feature-box">
        <a href="#">
          <img src="  {{url('/images/product_image/feature_'.$i.'.jpg')}}   " alt="">
        </a>
          {{-- text --}} 
      </div> 
      <span>T-shirt {{$i}}</span>
   
    </li>
    @endfor
    
    
  </ul>
</section>