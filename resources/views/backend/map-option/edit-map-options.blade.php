@extends('layouts/backend/layout') 
@section('title') Update Google map options
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
      <h3 class="font-bold col-teal">Update Map Options</h3>
    </div>
    <!--end user heading -->
    <form action="{{ route('map-option.update',$edit->id) }}" method="post">
      @csrf @method('PUT')
      <div class="row clearfix">
        <div class="col-lg-12">
          <div class="card m-t-30">
            <div class="card-body p-2">
              <div class="form-group {{ $errors->has('api_key') ? 'is-invalid' : '' }}">
                <label for="api_key">Api key <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="api_key" value="{{  $edit->api_key }}" id="api_key">
                <span class="text-danger">{{ $errors->has('api_key') ? $errors->first('api_key') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('zoom') ? 'is-invalid' : '' }}">
                <label for="zoom">Zoom Label <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="zoom" value="{{ $edit->zoom }}" id="zoom">
                <span class="text-danger">{{ $errors->has('zoom') ? $errors->first('zoom') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('lat') ? 'is-invalid' : '' }}">
                <label for="lat">Map Latitude <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="lat" value="{{ $edit->lat }}" id="lat">
                <span class="text-danger">{{ $errors->has('lat') ? $errors->first('lat') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('lng') ? 'is-invalid' : '' }}">
                <label for="lng">Map Longitude <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="lng" value="{{ $edit->lng }}" id="lng">
                <span class="text-danger">{{ $errors->has('lng') ? $errors->first('lng') : '' }}</span>
              </div>
              <div class="form-group">
                <input type="submit" value="Update" class="btn btn-raised bg-black waves-effect waves-light text-white button-item">
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