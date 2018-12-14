@extends('layouts/backend/layout') 
@section('title') Edit power information
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
      <h3 class="font-bold col-teal">Edit Power Info</h3>
      <a href="{{ route('power-info.index') }}" class="btn  btn-raised bg-light-green waves-effect text-white button-item"> <i class="material-icons">chevron_left</i> &nbsp; <span class="text-capitalize font-bold">Back</span></a>
    </div>

    <!--end user heading -->
    <!--end user heading -->
    <form action="{{ route('power-info.update',$edit->id) }}" method="post" enctype="multipart/form-data">
      @csrf @method('PUT')
      <div class="row clearfix">
        <div class="col-lg-12">
          <div class="card m-t-30">
            <div class="card-body p-2">
              <div class="form-group {{ $errors->has('info') ? 'is-invalid' : '' }}">
                <label for="info">Power infomation <span class="text-danger">(Requried)</span></label>
                <textarea name="info" cols="30" rows="10" class="textarea" id="info">
                                  {{ $edit->info }}
                   </textarea>
                <span class="text-danger">{{ $errors->has('info') ? $errors->first('info') : '' }}</span>
              </div>
              <h3>Add Google Map Latitude and Longitude</h3>
              <div class="form-group {{ $errors->has('map_lat') ? 'is-invalid' : '' }}">
                <label for="map_lat">Map Latitude <span class="text-danger">(Requried)</span></label>
                <input type="text" class="form-control" name="map_lat" value="{{ $edit->map_lat }}">
                <span class="text-danger">{{ $errors->has('map_lat') ? $errors->first('map_lat') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('map_lng') ? 'is-invalid' : '' }}">
                <label for="map_lng">Map Longitude <span class="text-danger">(Requried)</span></label>
                <input type="text" class="form-control" name="map_lng" value="{{ $edit->map_lng }}">
                <span class="text-danger">{{ $errors->has('map_lng') ? $errors->first('map_lng') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('zoom') ? 'is-invalid' : '' }}">
                <label for="zoom">Map Zoom <span class="text-danger">(Requried)</span></label>
                <input type="text" class="form-control" name="zoom" value="{{ $edit->zoom }}">
                <span class="text-danger">{{ $errors->has('zoom') ? $errors->first('zoom') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('marker_lat') ? 'is-invalid' : '' }}">
                <label for="marker_lat">Marker Latitude <span class="text-danger">(Requried)</span></label>
                <input type="text" class="form-control" name="marker_lat" value="{{ $edit->marker_lat }}">
                <span class="text-danger">{{ $errors->has('marker_lat') ? $errors->first('marker_lat') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('marker_lng') ? 'is-invalid' : '' }}">
                <label for="marker_lng">Marker Longitude <span class="text-danger">(Requried)</span></label>
                <input type="text" class="form-control" name="marker_lng" value="{{ $edit->marker_lng }}">
                <span class="text-danger">{{ $errors->has('marker_lng') ? $errors->first('marker_lng') : '' }}</span>
              </div>
              <div class="form-group">
                <label for="logo">Main Logo <span class="text-danger ">(Optional)</span></label>
                <input type="file" class="form-control " name="logo"> @if($edit->logo == 'photo') No photo found @else
                <img src="{{ asset( 'uploads/power_info/'.$edit->logo) }}" alt="logo"> @endif
              </div>
              <h3>Address</h3>
              <div class="form-group">
                <label for="address">Address<span class="text-danger">(Optional)</span></label>
                <textarea name="address" id="address" cols="30" rows="10" class="textarea" placeholder="write short address">{{ $edit->address }}</textarea>
              </div>
              <div class="form-group">
                <label for="email">Email Address <span class="text-danger">(Optional)</span></label>
                <input type="text" class="form-control" name="email" value="{{ $edit->email }}" placeholder="example@gmail.com" id="email">
              </div>
              <div class="form-group">
                <label for="phone">Phone<span class="text-danger">(Optional)</span></label>
                <input type="text" class="form-control" name="phone" value="{{ $edit->phone }}" id="phone">
              </div>
              <div class="form-group">
                <label for="fax">Fax Number<span class="text-danger">(Optional)</span></label>
                <input type="text" class="form-control" name="fax" value="{{ $edit->fax }}" id="fax">
              </div>
              <h3>Social and website linke</h3>
              <div class="form-group">
                <label for="twitter">Twitter Link <span class="text-danger">(Optional)</span></label>
                <input type="text" class="form-control" name="twitter" value="{{  $edit->twitter }}" id="twitter">
              </div>
              <div class="form-group">
                <label for="youtube">Youtube Link <span class="text-danger">(Optional)</span></label>
                <input type="text" class="form-control" name="youtube" value="{{  $edit->youtube }}" id="youtube">
              </div>
              <div class="form-group">
                <label for="facebook">Facebook Link <span class="text-danger">(Optional)</span></label>
                <input type="text" class="form-control" name="facebook" value="{{  $edit->facebook }}" id="facebook">
              </div>
              <div class="form-group">
                <label for="website">Website Link <span class="text-danger">(Optional)</span></label>
                <input type="text" class="form-control" name="website" value="{{ $edit->website }}" id="website">
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