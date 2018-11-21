@extends('layouts/backend/layout') 
@section('title') Add new distribution info
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
      <h3 class="font-bold col-teal">Add New distribution info</h3>
      <a href="{{ route('distributions-info.index') }}" class="btn  btn-raised bg-light-green waves-effect text-white button-item"> <i class="material-icons">chevron_left</i> &nbsp; <span class="text-capitalize font-bold">Back</span></a>
    </div>

    <!--end user heading -->
    <form action="{{ route('distributions-info.store') }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="row clearfix">
        <div class="col-lg-12">
          <div class="card m-t-30">
            <div class="card-body p-2">

              <div class="form-group {{ $errors->has('distribution_id') ? 'is-invalid' : '' }}">
                <label for="display_name">Select distribution <span class="text-danger">(Requried)</span></label> @if($id)
                <input type="hidden" name="distribution_id" value="{{ $id }}"> @endif
                <select id="select2" name="distribution_id" class="form-control" style="width: 100%" @if($id) disabled @endif> 
                                  <option value="">-- select distribution plant --</option>
                                   @foreach($distributions as $distribution)  
                                      <option value="{{  $distribution->id }}"
                                           @if($id == $distribution->id) selected   @endif
                                        >{{  $distribution->name }}</option>  
                                  @endforeach   
                      </select>

                <span class="text-danger">{{ $errors->has('distribution_id') ? $errors->first('distribution_id') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('info') ? 'is-invalid' : '' }}">
                <label for="info">distribution infomation <span class="text-danger">(Requried)</span></label>
                <textarea name="info" cols="10" rows="5" class="textarea" placeholder="Write distribution info" id="info">{{ old('info') }}</textarea>
                <span class="text-danger">{{ $errors->has('info') ? $errors->first('info') : '' }}</span>
              </div>
              <h3>Add Google Map Latitude and Longitude</h3>
              <div class="form-group {{ $errors->has('lat') ? 'is-invalid' : '' }}">
                <label for="lat">Latitude <span class="text-danger">(Requried)</span></label>
                <input type="text" class="form-control" name="lat" value="{{old('lat')}}" placeholder="example:-  -24.397">
                <span class="text-danger">{{ $errors->has('lat') ? $errors->first('lat') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('lng') ? 'is-invalid' : '' }}">
                <label for="lng">Longitude <span class="text-danger">(Requried)</span></label>
                <input type="text" class="form-control" name="lng" value="{{old('lng')}}" placeholder="example:- 24.397">
                <span class="text-danger">{{ $errors->has('lng') ? $errors->first('lng') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('logo') ? 'is-invalid' : '' }}">
                <label for="logo">Main Logo <span class="text-danger">(Optional)</span></label>
                <input type="file" class="form-control" name="logo">
                <span class="text-danger">{{ $errors->has('logo') ? $errors->first('logo') : '' }}</span>
              </div>
              <h3>Address</h3>
              <div class="form-group">
                <label for="address">Address<span class="text-danger">(Optional)</span></label>
                <textarea name="address" id="address" cols="30" rows="10" class="textarea" placeholder="write short address"></textarea>
              </div>
              <div class="form-group">
                <label for="email">Email Address <span class="text-danger">(Optional)</span></label>
                <input type="text" class="form-control" name="email" value="{{old('email')}}" placeholder="example@gmail.com" id="email">
              </div>
              <div class="form-group">
                <label for="phone">Phone<span class="text-danger">(Optional)</span></label>
                <input type="text" class="form-control" name="phone" value="{{old('phone')}}" placeholder="phone number" id="phone">
              </div>
              <div class="form-group">
                <label for="fax">Fax Number<span class="text-danger">(Optional)</span></label>
                <input type="text" class="form-control" name="fax" value="{{old('fax')}}" placeholder="fax number" id="fax">
              </div>
              <h3>Social and website linke</h3>
              <div class="form-group">
                <label for="twitter">Twitter Link <span class="text-danger">(Optional)</span></label>
                <input type="text" class="form-control" name="twitter" value="{{old('twitter')}}" placeholder="http://www.twitter.com" id="twitter">
              </div>
              <div class="form-group">
                <label for="youtube">Youtube Link <span class="text-danger">(Optional)</span></label>
                <input type="text" class="form-control" name="youtube" value="{{old('youtube')}}" placeholder="http://www.youtube.com" id="youtube">
              </div>
              <div class="form-group">
                <label for="facebook">facebook Link <span class="text-danger">(Optional)</span></label>
                <input type="text" class="form-control" name="facebook" value="{{old('facebook')}}" placeholder="http://www.facebook.com"
                  id="facebook">
              </div>
              <div class="form-group">
                <label for="website">Website Link <span class="text-danger">(Optional)</span></label>
                <input type="text" class="form-control" name="website" value="{{old('website')}}" placeholder="http://www.example.com" id="website">
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
<script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
<script>
  $(function(){
      $('#select2').select2();
      CKEDITOR.replace('info');
        CKEDITOR.config.height = 300; 
    });

</script>








































@endpush