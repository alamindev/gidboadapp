@extends('layouts/backend/layout') 
@section('title') Google map options
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
      <h3 class="font-bold col-teal">Map Options</h3>
    </div>
    <!--end user heading -->
    <form action="{{ route('map-option.store') }}" method="post">
      @csrf
      <div class="row clearfix">
        <div class="col-lg-12">
          <div class="card m-t-30">
            <div class="card-body p-2">
              <div class="form-group {{ $errors->has('api_key') ? 'is-invalid' : '' }}">
                <label for="api_key">Api key <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="api_key" value="{{old('api_key')}}" placeholder="example:- 54d5d24s5s1s5_d45"
                  id="api_key">
                <span class="text-danger">{{ $errors->has('api_key') ? $errors->first('api_key') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('zoom') ? 'is-invalid' : '' }}">
                <label for="zoom">Zoom Label <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="zoom" value="{{old('zoom')}}" placeholder="example:- 2 or 4 or 8......" id="zoom">
                <span class="text-danger">{{ $errors->has('zoom') ? $errors->first('zoom') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('lat') ? 'is-invalid' : '' }}">
                <label for="lat">Map Latitude <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="lat" value="{{old('lat')}}" placeholder="example:- -34.397" id="lat">
                <span class="text-danger">{{ $errors->has('lat') ? $errors->first('lat') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('lng') ? 'is-invalid' : '' }}">
                <label for="lng">Map Longitude <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="lng" value="{{old('lng')}}" placeholder="example:- 150.644" id="lng">
                <span class="text-danger">{{ $errors->has('lng') ? $errors->first('lng') : '' }}</span>
              </div>
              <div class="form-group">
                <input type="submit" value="Save" class="btn  btn-raised bg-teal waves-effect text-white button-item">
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