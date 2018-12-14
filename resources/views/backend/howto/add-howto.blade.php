@extends('layouts/backend/layout') 
@section('title') Add how to and about
@endsection
 
@section('main-content')
<!-- Main Content -->

<!-- Main Content -->
<section class="content home">
  <div class="container-fluid">
    <div class="block-header">
      <div class="row">
        <div class="col-lg-12 col-md-6 col-sm-7">
          <h2 class="top-dashboard">Dashboard</h2>
  @include('_includes/breadcrumb')
        </div>
      </div>
    </div>
    <!--end Bread crumbs-->
    <!--coding for user heading-->
    <div class="heading">
      <h3 class="font-bold col-teal">Add how to and about</h3>
    </div>
    <div class="card">
        <div class="card-body p-4">
            <howto-upload></howto-upload>
        </div>
      </div>
      <!--end user heading -->
    <!--end user heading -->
    <form action="{{ route('howtos.store') }}" method="post">
      @csrf
      <div class="row clearfix">
        <div class="col-lg-12">
          <div class="card m-t-30">
            <div class="card-body p-2">
              <div class="form-group {{ $errors->has('help') ? 'is-invalid' : '' }}">
                <label for="help">Add Help And how to <span class="text-danger">(Use Image from google drive inside text:- https://drive.google.com/open?id=xxxxxxx change the open? to uc? and use it like:- https://drive.google.com/uc?id=xxxxx)</span></label>
                <textarea name="help" id="help" cols="30" rows="10" placeholder="write info for this chart"></textarea>
                <span class="text-danger">{{ $errors->has('help') ? $errors->first('help') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('about') ? 'is-invalid' : '' }}">
                <label for="about">Add About info <span class="text-danger">(Use Image from google drive inside text:- https://drive.google.com/open?id=xxxxxxx change the open? to uc? and use it like:- https://drive.google.com/uc?id=xxxxx)</span></label>
                <textarea name="about" id="about" cols="30" rows="10" placeholder="write info for Supply mix"></textarea>
                <span class="text-danger">{{ $errors->has('about') ? $errors->first('about') : '' }}</span>
              </div>
              <div class="form-group">
                <input type="submit" value="Save" class="btn btn-raised bg-blue waves-effect text-white button-item">
              </div>
            </div>
            <!--end card body-->
          </div>
        </div>
        <!--end column-->
      </div>
      <!--end main row-->
    </form>
  </div>
</section>
@endsection
 @push('scripts')
<script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
<script>
    var app = new Vue({
        el: '#app', 
    });
  $(function () {
    //CKEditor
    CKEDITOR.replace('about');
    CKEDITOR.config.height = 300; 
    //CKEditor
    CKEDITOR.replace('help');
    CKEDITOR.config.height = 300; 
});

</script>















@endpush