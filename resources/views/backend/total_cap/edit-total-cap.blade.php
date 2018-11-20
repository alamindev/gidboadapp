@extends('layouts/backend/layout') 
@section('title') Update Total Capacity
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
      <h3 class="font-bold col-teal">Update Total Capacity info</h3>
    </div>
    <!--end user heading -->
    <form action="{{ route('total-capacity.update',$edit->id) }}" method="post">
      @csrf @method('PUT')
      <div class="row clearfix">
        <div class="col-lg-12">
          <div class="card m-t-30">
            <div class="card-body p-2">
              <div class="form-group {{ $errors->has('info_pie') ? 'is-invalid' : '' }}">
                <label for="info_pie">Add Chart Infomation<span class="text-danger">*</span></label>
                <textarea name="info_pie" id="info_pie" cols="30" rows="10">{{ $edit->info_pie }}</textarea>
                <span class="text-danger">{{ $errors->has('info_pie') ? $errors->first('info_pie') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('supply_mix') ? 'is-invalid' : '' }}">
                <label for="supply_mix">Add Chart Infomation<span class="text-danger">*</span></label>
                <textarea name="supply_mix" id="supply_mix" cols="30" rows="10">{{ $edit->supply_mix }}</textarea>
                <span class="text-danger">{{ $errors->has('supply_mix') ? $errors->first('supply_mix') : '' }}</span>
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
 @push('scripts')
<script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
<script>
  $(function () {
    //CKEditor
    CKEDITOR.replace('info_pie');
    CKEDITOR.config.height = 300; 
    //CKEditor
    CKEDITOR.replace('supply_mix');
    CKEDITOR.config.height = 300; 
});

</script>
















@endpush