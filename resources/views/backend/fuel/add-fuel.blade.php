@extends('layouts/backend/layout') 
@section('title') Fuels
@endsection
 @push('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css') }}" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> 
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
      <h3 class="font-bold col-teal">Add New Fuel</h3>
      <a href="{{ route('fuels.index') }}" class="btn  btn-raised bg-light-green waves-effect text-white button-item"> <i class="material-icons">chevron_left</i> &nbsp; <span class="text-capitalize font-bold">Back</span></a>
    </div>

    <!--end user heading -->
    <form action="{{ route('fuels.store') }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="row clearfix">
        <div class="col-lg-12">
          <div class="card m-t-30">
            <div class="card-body p-2">
              <div class="form-group {{ $errors->has('name') ? 'is-invalid' : '' }}">
                <label for="name">Fuel Type</label>
                <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Write Fuel Type" id="name">
                <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('total') ? 'is-invalid' : '' }}">
                <label for="total">Capacity <span class="text-danger">(  This value need for percent calculation   )</span></label>
                <input type="text" class="form-control" name="total" value="{{old('total')}}" placeholder="example: 16000" id="total">
                <span class="text-danger">{{ $errors->has('total') ? $errors->first('total') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('install_cap') ? 'is-invalid' : '' }}">
                <label for="install_cap">Total Installed Capacity <span class="text-danger">( required  )</span></label>
                <input type="text" class="form-control" name="install_cap" value="{{old('install_cap')}}" placeholder="example: 16000" id="install_cap">
                <span class="text-danger">{{ $errors->has('install_cap') ? $errors->first('install_cap') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('install_date') ? 'is-invalid' : '' }}">
                <label for="install_date">Installed Capacity Date<span class="text-danger">( required  )</span></label>
                <input type="text" class="form-control" name="install_date" value="{{old('install_date')}}" id="install_date">
                <span class="text-danger">{{ $errors->has('install_date') ? $errors->first('install_date') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('bg_color') ? 'is-invalid' : '' }} ">
                <label for="bg_color">HEX CODE</label>
                <div class="input-group colorpicker">
                  <div class="form-line">
                    <input type="text" class="form-control" placeholder="#00AABB" name="bg_color" id="bg_color">
                  </div>
                  <span class="input-group-addon"> <i></i> </span> </div>
                <span class="text-danger">{{ $errors->has('bg_color') ? $errors->first('bg_color') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('logo') ? 'is-invalid' : '' }}">
                <label for="logo">Logo</label>
                <input type="file" class="form-control" name="logo">
                <span class="text-danger">{{ $errors->has('logo') ? $errors->first('logo') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('map_icon') ? 'is-invalid' : '' }}">
                <label for="map_icon">Google Map Icon</label>
                <input type="file" class="form-control" name="map_icon">
                <span class="text-danger">{{ $errors->has('map_icon') ? $errors->first('map_icon') : '' }}</span>
              </div>
              <div class="form-group">
                <input type="submit" value="Save" class="btn btn-raised bg-light-green waves-effect text-white button-item">
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
<script src="{{ asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $(function () {
  $('.colorpicker').colorpicker();
  $( "#install_date" ).datepicker({
     autoclose: true,
        format: 'yyyy-mm-dd',
        todayHighlight: true
  });
});

</script>




@endpush