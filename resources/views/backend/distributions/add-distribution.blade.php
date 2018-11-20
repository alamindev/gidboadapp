@extends('layouts/backend/layout') 
@section('title') Add New Distribution
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
      <h3 class="font-bold col-teal">Add New Distribution</h3>
      <a href="{{ route('distributions.index') }}" class="btn  btn-raised bg-light-green waves-effect text-white button-item"> <i class="material-icons">chevron_left</i> &nbsp; <span class="text-capitalize font-bold">Back</span></a>
    </div>

    <!--end user heading -->
    <form action="{{ route('distributions.store') }}" method="post">
      @csrf
      <div class="row clearfix">
        <div class="col-lg-12">
          <div class="card m-t-30">
            <div class="card-body p-2">
              <div class="form-group {{ $errors->has('name') ? 'is-invalid' : '' }}">
                <label for="name">Disco Name</label>
                <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Write Disco name" id="name">
                <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('demand') ? 'is-invalid' : '' }}">
                <label for="demand">demand</label>
                <input type="text" class="form-control" name="demand" value="{{old('demand')}}" placeholder="example:- 5000" id="demand">
                <span class="text-danger">{{ $errors->has('demand') ? $errors->first('demand') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('receive') ? 'is-invalid' : '' }}">
                <label for="receive">Receive</label>
                <input type="text" class="form-control" name="receive" value="{{old('receive')}}" placeholder="example:- 4000" id="receive">
                <span class="text-danger">{{ $errors->has('receive') ? $errors->first('receive') : '' }}</span>
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