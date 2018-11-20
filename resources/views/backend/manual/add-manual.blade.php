@extends('layouts/backend/layout') 
@section('title') Add Manual Capacity
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
      <h3 class="font-bold col-teal">Add New Manual Capacity</h3>
      <a href="{{ route('manuals.index') }}" class="btn  btn-raised bg-light-green waves-effect text-white button-item"> <i class="material-icons">chevron_left</i> &nbsp; <span class="text-capitalize font-bold">Back</span></a>
    </div>

    <!--end user heading -->
    <form action="{{ route('manuals.store') }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="row clearfix">
        <div class="col-lg-12">
          <div class="card m-t-30">
            <div class="card-body p-2">
              <div class="form-group {{ $errors->has('national_demand') ? 'is-invalid' : '' }}">
                <label for="national_demand"> National demand </label>
                <input type="text" class="form-control" name="national_demand" value="{{old('national_demand')}}" placeholder="example:- 50000"
                  id="national_demand">
                <span class="text-danger">{{ $errors->has('national_demand') ? $errors->first('national_demand') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('available_capacity') ? 'is-invalid' : '' }}">
                <label for="available_capacity">Available Capacity</label>
                <input type="text" class="form-control" name="available_capacity" value="{{old('available_capacity')}}" placeholder="example:- 50000"
                  id="available_capacity">
                <span class="text-danger">{{ $errors->has('available_capacity') ? $errors->first('available_capacity') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('transmission_capacity') ? 'is-invalid' : '' }}">
                <label for="transmission_capacity"> Transmission Capacity </label>
                <input type="text" class="form-control" name="transmission_capacity" value="{{old('transmission_capacity')}}" placeholder="example:- 50000"
                  id="transmission_capacity">
                <span class="text-danger">{{ $errors->has('transmission_capacity') ? $errors->first('transmission_capacity') : '' }}</span>
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