@extends('frontend/layout') 
@section('title') How the grid works
@endsection
 
@section('main-content')
<!--start coding for main card-->
<div class="row">
  <div class="col-lg-12">
    <div class="card mt-4">
      <div class="card-body">
        <div class="flexslider">
          <ul class="slides">
            @foreach($sliders as $slider)
            <li>
              <img src="{{ asset('uploads/slider/'.$slider->logo) }}" alt="{{ $slider->title }}" />
              <div class="overlay">
                <div class="slider_title">
                  <p>{{ $slider->title }}</p>
                </div>
                <div class="slider_body">
                  <p>{{ $slider->details }}</p>
                </div>
              </div>
            </li>
            @endforeach

          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
 @push('scripts')
<script src="{{ asset('js/flexslider.min.js') }}"></script>
<script>
  $(function(){
  $('.flexslider').flexslider({
        animation: "slide", 
      });
})

</script>


























@endpush