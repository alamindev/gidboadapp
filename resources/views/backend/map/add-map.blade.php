@extends('layouts/backend/layout') 
@section('title') Add Map information
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
      <h3 class="font-bold col-teal">Add New Map Information</h3>
      <a href="{{ route('map-info.index') }}" class="btn  btn-raised bg-light-green waves-effect text-white button-item"> <i class="material-icons">chevron_left</i> &nbsp; <span class="text-capitalize font-bold">Back</span></a>
    </div>

    <!--end user heading -->
    <form action="{{ route('map-info.store') }}" method="post">
      @csrf
      <div class="row clearfix">
        <div class="col-lg-12">
          <div class="card m-t-30">
            <div class="card-body p-2">
              <div class="form-group {{ $errors->has('per_table') ? 'is-invalid' : '' }}">
                <label for="display_name">Select Fuel Type <span class="text-danger">(Requried)</span></label>
                <select id="select2" name="fuel_id" class="form-control" style="width: 100%"> 
                                  <option value=""> -- select Fuel Type -- </option>
                                   @foreach($fuels as $fuel)  
                                      <option value="{{  $fuel->id }}">{{  $fuel->name }}</option>  
                                  @endforeach   
                      </select>

                <span class="text-danger">{{ $errors->has('fuel_id') ? $errors->first('fuel_id') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('title') ? 'is-invalid' : '' }}">
                <label for="title">Map title <span class="text-danger">(Requried)</span></label>
                <input type="text" class="form-control" name="title" value="{{old('title')}}" placeholder="write title" id="title">
                <span class="text-danger">{{ $errors->has('title') ? $errors->first('title') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('info') ? 'is-invalid' : '' }}">
                <label for="info">Map infomation <span class="text-danger">(Requried)</span></label>
                <textarea name="info" cols="10" rows="5" class="textarea" placeholder="Write Power info" id="info">{{ old('info') }}</textarea>
                <span class="text-danger">{{ $errors->has('info') ? $errors->first('info') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('lat') ? 'is-invalid' : '' }}">
                <label for="lat">Map Latitude <span class="text-danger">(Requried)</span></label>
                <input type="text" class="form-control" name="lat" value="{{old('lat')}}" placeholder="example:- 24.397" id="lat">
                <span class="text-danger">{{ $errors->has('lat') ? $errors->first('lat') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('lng') ? 'is-invalid' : '' }}">
                <label for="lng">Map Longitude <span class="text-danger">(Requried)</span></label>
                <input type="text" class="form-control" name="lng" value="{{old('lng')}}" placeholder="example:- 24.397" id="lng">
                <span class="text-danger">{{ $errors->has('lng') ? $errors->first('lng') : '' }}</span>
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
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>

<script>
  $(function(){
      $('#select2').select2();
      
    });

</script>





@endpush