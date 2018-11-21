@extends('layouts/backend/layout') 
@section('title') Update Help And About us
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
      <h3 class="font-bold col-teal">Update Help And About us</h3>
    </div>
    <!--end user heading -->
    <form action="{{ route('howtos.update',$edit->id) }}" method="post">
      @csrf @method('PUT')
      <div class="row clearfix">
        <div class="col-lg-12">
          <div class="card m-t-30">
            <div class="card-body p-2">
              <div class="form-group {{ $errors->has('help') ? 'is-invalid' : '' }}">
                <label for="help">Add Chart Infomation<span class="text-danger">*</span></label>
                <textarea name="help" id="help" cols="30" rows="10">{{ $edit->help }}</textarea>
                <span class="text-danger">{{ $errors->has('help') ? $errors->first('help') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('about ') ? 'is-invalid' : '' }}">
                <label for="about ">Add Chart Infomation<span class="text-danger">*</span></label>
                <textarea name="about" id="about" cols="30" rows="10">{{ $edit->about  }}</textarea>
                <span class="text-danger">{{ $errors->has('about ') ? $errors->first('about ') : '' }}</span>
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
    CKEDITOR.replace('help');
    CKEDITOR.config.height = 300; 
    //CKEditor
    CKEDITOR.replace('about');
    CKEDITOR.config.height = 300; 
});

</script> 


@endpush