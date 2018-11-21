@extends('frontend/layout') 
@section('title') Help & about
@endsection
 @push('styles')
<style>
  .gridwatch-block-help-about-lg {
    width: 100%;
    height: 668px;
    float: left;
    position: relative;
    margin-top: 10px;
    margin-bottom: 10px;
    background: #ffffff;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    -webkit-overflow-scrolling: touch;
  }

  .gridwatch-block-help-about-header-lg {
    height: 40px;
    font-size: 16px;
    padding: 10px;
    margin-bottom: 10px;
    border-bottom: 1pt solid #efeff4;
  }

  .column-box-body-help-about-lg {
    text-align: left;
    font-size: 14px;
    padding-left: 10px;
    padding-right: 10px;
    margin: auto;
    height: 610px;
    overflow-y: auto;
  }
</style>






@endpush 
@section('main-content')
<!--start coding for main card-->
<div class="row">
  <div class="col-lg-6">
    <div class="gridwatch-block-help-about-lg">
      <div class="gridwatch-block-help-about-header-lg">
        HELP &amp; HOW TO
      </div>
      <div class="column-box-body-help-about-lg">
        <br>
         @if(!empty($aboutandhow->help))
          {!! $aboutandhow->help !!}
         @endif
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="gridwatch-block-help-about-lg">
      <div class="gridwatch-block-help-about-header-lg">
        ABOUT GRIDWATCH
      </div>
      <div class="column-box-body-help-about-lg">
        <br>
        @if(!empty($aboutandhow->about))
        {!! $aboutandhow->about !!}
       @endif
      </div>
    </div>
  </div>
</div>
@endsection