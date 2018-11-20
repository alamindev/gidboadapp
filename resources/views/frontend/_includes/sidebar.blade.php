<aside class="sidebar" id="aside">
  <div class="page-navigation">
    @empty(!$general->main_logo)
    <div class="sidebar_info">
      <a href="{{ route('home.index') }}">
       <img src="{{ asset('uploads/general/'.$general->main_logo) }}" alt="logo" class="img-fluid">
     </a>
    </div>
    @endempty
    <ul class="sidebar_main">
      @empty(!$general->side_icon_1 && $general->side_title_1)
      <li class="sider_item">
        <a class="{{ Nav::isRoute('home.index') }}" href="{{ route('home.index') }}">
             <img src="{{ asset('uploads/general/'.$general->side_icon_1) }}" alt="Most Recent Hour">
              <span>{{ $general->side_title_1 }}</span>
            </a>
      </li>
      @endempty @empty(!$general->side_icon_2 && $general->side_title_2)
      <li class="sider_item">
        <a class="{{ Nav::isRoute('get.trends') }}" href="{{ route('get.trends') }}">
             <img src="{{ asset('uploads/general/'.$general->side_icon_2) }}" alt="treans">
              <span>{{ $general->side_title_2 }}</span>
            </a>
      </li>
      @endempty @empty(!$general->side_icon_3 && $general->side_title_3)
      <li class="sider_item">
        <a class="{{ Nav::isRoute('get.generation') }}" href="{{ route('get.generation') }}">
                   <img src="{{ asset('uploads/general/'.$general->side_icon_3) }}" alt="generation">
                    <span>{{ $general->side_title_3 }}</span>
                  </a>
      </li>
      @endempty @empty(!$general->side_icon_5 && $general->side_title_5)
      <li class="sider_item">
        <a class="{{ Nav::isRoute('get.map') }}" href="{{ route('get.map') }}">
                               <img src="{{ asset('uploads/general/'.$general->side_icon_5) }}" alt="map">
                                <span>{{ $general->side_title_5 }}</span>
                              </a>
      </li>
      @endempty @empty(!$general->side_icon_6 && $general->side_title_6)
      <li class="sider_item">
        <a class="{{ Nav::isRoute('get.totalCapacity') }}" href="{{ route('get.totalCapacity') }}">
          <img src="{{ asset('uploads/general/'.$general->side_icon_6) }}" alt="capacity">
               <span>{{ $general->side_title_6 }}</span>
             </a>
      </li>
      @endempty @empty(!$general->side_icon_7 && $general->side_title_7)
      <li class="sider_item">
        <a class="{{ Nav::isRoute('get.HowItWork') }}" href="{{ route('get.HowItWork') }}">
          <img src="{{ asset('uploads/general/'.$general->side_icon_7) }}" alt="how to work">
               <span>{{ $general->side_title_7 }}</span>
             </a>
      </li>
      @endempty @empty(!$general->side_icon_8 && $general->side_title_8)
      <li class="sider_item">
        <a class="{{ Nav::isRoute('get.HelpAbout') }}" href="{{ route('get.HelpAbout') }}">
                <img src="{{ asset('uploads/general/'.$general->side_icon_8) }}" alt="help about">
                     <span>{{ $general->side_title_8 }}</span>
                   </a>
      </li>
      @endempty


    </ul>
  </div>
</aside>