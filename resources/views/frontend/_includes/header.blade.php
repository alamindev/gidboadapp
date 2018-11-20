<!-- Header -->
<header class="header">
  <nav class="navbar  navbar-light bg-light page-head">
    <p id="icon_menu" style="cursor: pointer; margin: 0;">
      <img src="{{ asset('images/icon-webapp-menu.png') }}" alt="Menu">
    </p>
    <ul class="navbar-nav d-flex justify-content-center">
      @if(Request::is('/'))
      <li>
        {{ $hour }}
      </li>
      @else
      <li>{{ str_replace('-', ' ', \Request::path()) }}</li>
      @endif

    </ul>
    <ul class="navbar-nav d-flex">
      @if(Request::is('plant-map'))
      <li class="nav-item">
        <a class="nav-link" href="#" id="right_side">  
                <img src="{{ asset('images/icon-webapp-menu-filter.png') }}" alt="Menu">
                  </a>
      </li>
      @endif @if(Request::is('/'))
      <li class="nav-item">
        <a class="nav-link" href="#" onClick="window.location.reload()">  
                            <img src="{{ asset('images/icon-webapp-refresh.png') }}" alt="Page Refrash">
                          </a>
      </li>
      @endif


    </ul>
  </nav>
</header>