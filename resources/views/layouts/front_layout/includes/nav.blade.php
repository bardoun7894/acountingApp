  {{-- navigation --}}

  <nav class="nav">
      <div class="social-call">
          <div class="social">
              <a href=""><i class="fab fa-facebook-f"></i></a>
              <a href=""><i class="fab fa-twitter"></i></a>
              <a href=""><i class="fab fa-instagram"></i></a>
              <a href=""><i class="fab fa-youtube"></i></a>
          </div>
          <div class="phone">
              <a><i class="fas fa-phone-alt"></i> +212708150351 </a>
          </div>
      </div>
      {{-- menu bar --}}
      <div class="navigation">
          {{-- logo --}}
          <a href="#" class="logo">
              <img src="{{ url('/images/logo/Logo111.png') }}" style="width: 100px;height:70px" alt="" />
          </a>
          {{-- menu icon --}}
          <div class="toggle"></div>
          {{-- menu --}}
          <ul class="menu">
              @foreach ($links as $link)
                  <li><a href="{{ url('/front/' . $link->url) }}">{{ $link->link_name }}</a></li>
              @endforeach
              <li> <a href="#">NameSec</a>
                  {{-- sale lable --}}
                  <span class="sale-lable">Sale</span>

              </li>
          </ul>
          {{-- right menu --}}
          <div class="right-menu">
              <a href="#" class="search">
                  <i class="fas fa-search"></i>
              </a>
              <a href="#" class="user">
                  <i class="fas fa-user"></i>
              </a>
              <a href="#">
                  <i class="fas fa-shopping-cart">
                      <span class="num-cart-product"> 0 </span>
                  </i>
              </a>
          </div>
          </a>
      </div>
  </nav>
