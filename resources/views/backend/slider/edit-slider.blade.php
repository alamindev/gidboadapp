@extends('layouts/backend/layout') 
@section('title') Edit Slider
@endsection
 @push('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.css') }}"> 
@endpush 
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
      <h3 class="font-bold col-teal">Edit Slider</h3>
      <a href="{{ route('slider.index') }}" class="btn  btn-raised bg-light-green waves-effect text-white button-item"> <i class="material-icons">chevron_left</i> &nbsp; <span class="text-capitalize font-bold">Back</span></a>
    </div>

    <!--end user heading -->
    <!--end user heading -->
    <form action="{{ route('slider.update',$edit->id) }}" method="post" enctype="multipart/form-data">
      @csrf @method('PUT')
      <div class="row clearfix">
        <div class="col-lg-12">
          <div class="card m-t-30">
            <div class="card-body p-2">
              <div class="form-group {{ $errors->has('title') ? 'is-invalid' : '' }}">
                <label for="title">Slider Title <span class="text-danger">(Requried)</span></label>
                <input type="text" id="title" name="title" class="form-control" value="{{ $edit->title }}">
                <span class="text-danger">{{ $errors->has('title') ? $errors->first('title') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('details') ? 'is-invalid' : '' }}">
                <label for="details">Details <span class="text-danger">(Requried)</span></label>
                <textarea name="details" cols="10" rows="5" class="textarea" placeholder="Write Power details" id="details">{{ $edit->details }}</textarea>
                <span class="text-danger">{{ $errors->has('details') ? $errors->first('details') : '' }}</span>
              </div>
              <div class="form-group ">
                <label for="logo">Slider Image <span class="text-danger">(Requried)</span></label>
                <input type="file" class="form-control" name="logo">
                <img src="{{ asset('uploads/slider/'.$edit->logo) }}" alt="slider image" class="img-responsive" width="100">
              </div>
              <div class="form-group">
                <input type="submit" value="update" class="btn btn-raised bg-light-green waves-effect text-white button-item">
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
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>

<script>
  $(function(){
        $('#select2').select2();
        
      });

</script>



































































































@endpush