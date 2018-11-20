@extends('layouts/backend/layout') 
@section('title') Website general setting
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
      <h3 class="font-bold col-teal">General setting</h3>
    </div>
    <!--end user heading -->
    <form action="{{ route('general-setting.store') }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="row clearfix">
        <div class="col-lg-12">
          <div class="card m-t-30">
            <div class="card-body p-2">
              <h3>Website logo and favicon</h3>
              <div class="form-group {{ $errors->has('main_logo') ? 'is-invalid' : '' }}">
                <label for="main_logo">Upload Logo</label>
                <input type="file" class="form-control" name="main_logo">
                <span class="text-danger">{{ $errors->has('main_logo') ? $errors->first('main_logo') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('fav_icon') ? 'is-invalid' : '' }}">
                <label for="fav_icon">Upload Favicon</label>
                <input type="file" class="form-control" name="fav_icon">
                <span class="text-danger">{{ $errors->has('fav_icon') ? $errors->first('fav_icon') : '' }}</span>
              </div>
              <h3>Distribution Logo And Text</h3>
              <div class="form-group">
                <label for="distri_logo">Distribution Logo <span class="text-danger">(Optional)</span></label>
                <input type="file" class="form-control" name="distri_logo">
              </div>
              <div class="form-group {{ $errors->has('distri_text') ? 'is-invalid' : '' }}">
                <label for="distri_text">Distribution Text <span class="text-danger">(Required)</span></label>
                <input type="text" class="form-control" name="distri_text" placeholder="Distribution Text">
                <span class="text-danger">{{ $errors->has('distri_text') ? $errors->first('distri_text') : '' }}</span>
              </div>

              <h3>Website siderbar menu 1</h3>
              <div class="form-group {{ $errors->has('side_title_1') ? 'is-invalid' : '' }}">
                <label for="side_title_1">Menu 1 title<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="side_title_1" value="{{old('side_title_1')}}" placeholder="write title" id="side_title_1">
                <span class="text-danger">{{ $errors->has('side_title_1') ? $errors->first('side_title_1') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('side_icon_1') ? 'is-invalid' : '' }}">
                <label for="side_icon_1">Upload Sidebar Image</label>
                <input type="file" class="form-control" name="side_icon_1">
                <span class="text-danger">{{ $errors->has('side_icon_1') ? $errors->first('side_icon_1') : '' }}</span>
              </div>
              <h3>Website siderbar menu 2</h3>
              <div class="form-group {{ $errors->has('side_title_2') ? 'is-invalid' : '' }}">
                <label for="side_title_2">Menu 2 title<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="side_title_2" value="{{old('side_title_2')}}" placeholder="write title" id="side_title_2">
                <span class="text-danger">{{ $errors->has('side_title_2') ? $errors->first('side_title_2') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('side_icon_2') ? 'is-invalid' : '' }}">
                <label for="side_icon_2">Upload Sidebar Image</label>
                <input type="file" class="form-control" name="side_icon_2">
                <span class="text-danger">{{ $errors->has('side_icon_2') ? $errors->first('side_icon_2') : '' }}</span>
              </div>
              <h3>Website siderbar menu 3</h3>
              <div class="form-group {{ $errors->has('side_title_3') ? 'is-invalid' : '' }}">
                <label for="side_title_3">Menu 3 title<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="side_title_3" value="{{old('side_title_3')}}" placeholder="write title" id="side_title_3">
                <span class="text-danger">{{ $errors->has('side_title_3') ? $errors->first('side_title_3') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('side_icon_3') ? 'is-invalid' : '' }}">
                <label for="side_icon_3">Upload Sidebar Image</label>
                <input type="file" class="form-control" name="side_icon_3">
                <span class="text-danger">{{ $errors->has('side_icon_3') ? $errors->first('side_icon_3') : '' }}</span>
              </div>
              {{--
              <h3>Website siderbar menu 4</h3>
              <div class="form-group {{ $errors->has('side_title_4') ? 'is-invalid' : '' }}">
                <label for="side_title_4">Menu 4 title<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="side_title_4" value="{{old('side_title_4')}}" placeholder="write title" id="side_title_4">
                <span class="text-danger">{{ $errors->has('side_title_4') ? $errors->first('side_title_4') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('side_icon_4') ? 'is-invalid' : '' }}">
                <label for="side_icon_4">Upload Sidebar Image</label>
                <input type="file" class="form-control" name="side_icon_4">
                <span class="text-danger">{{ $errors->has('side_icon_4') ? $errors->first('side_icon_4') : '' }}</span>
              </div> --}}
              <h3>Website siderbar menu 4</h3>
              <div class="form-group {{ $errors->has('side_title_5') ? 'is-invalid' : '' }}">
                <label for="side_title_5">Menu 5 title<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="side_title_5" value="{{old('side_title_5')}}" placeholder="write title" id="side_title_5">
                <span class="text-danger">{{ $errors->has('side_title_5') ? $errors->first('side_title_5') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('side_icon_5') ? 'is-invalid' : '' }}">
                <label for="side_icon_5">Upload Sidebar Image</label>
                <input type="file" class="form-control" name="side_icon_5">
                <span class="text-danger">{{ $errors->has('side_icon_5') ? $errors->first('side_icon_5') : '' }}</span>
              </div>
              <h3>Website siderbar menu 5</h3>
              <div class="form-group {{ $errors->has('side_title_6') ? 'is-invalid' : '' }}">
                <label for="side_title_6">Menu 6 title<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="side_title_6" value="{{old('side_title_6')}}" placeholder="write title" id="side_title_6">
                <span class="text-danger">{{ $errors->has('side_title_6') ? $errors->first('side_title_6') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('side_icon_6') ? 'is-invalid' : '' }}">
                <label for="side_icon_6">Upload Sidebar Image</label>
                <input type="file" class="form-control" name="side_icon_6">
                <span class="text-danger">{{ $errors->has('side_icon_6') ? $errors->first('side_icon_6') : '' }}</span>
              </div>
              <h3>Website siderbar menu 6</h3>
              <div class="form-group {{ $errors->has('side_title_7') ? 'is-invalid' : '' }}">
                <label for="side_title_7">Menu 7 title<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="side_title_7" value="{{old('side_title_7')}}" placeholder="write title" id="side_title_7">
                <span class="text-danger">{{ $errors->has('side_title_7') ? $errors->first('side_title_7') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('side_icon_7') ? 'is-invalid' : '' }}">
                <label for="side_icon_7">Upload Sidebar Image</label>
                <input type="file" class="form-control" name="side_icon_7">
                <span class="text-danger">{{ $errors->has('side_icon_7') ? $errors->first('side_icon_7') : '' }}</span>
              </div>
              <h3>Website siderbar menu 7</h3>
              <div class="form-group {{ $errors->has('side_title_8') ? 'is-invalid' : '' }}">
                <label for="side_title_8">Menu 8 title<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="side_title_8" value="{{old('side_title_8')}}" placeholder="write title" id="side_title_8">
                <span class="text-danger">{{ $errors->has('side_title_8') ? $errors->first('side_title_8') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('side_icon_8') ? 'is-invalid' : '' }}">
                <label for="side_icon_8">Upload Sidebar Image</label>
                <input type="file" class="form-control" name="side_icon_8">
                <span class="text-danger">{{ $errors->has('side_icon_8') ? $errors->first('side_icon_8') : '' }}</span>
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