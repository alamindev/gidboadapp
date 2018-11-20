@extends('layouts/backend/layout') 
@section('title') Update General Setting
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
      <h3 class="font-bold col-teal">Update General Setting</h3>
    </div>
    <!--end user heading -->
    <form action="{{ route('general-setting.update',$edit->id) }}" method="post" enctype="multipart/form-data">
      @csrf @method('PUT')
      <div class="row clearfix">
        <div class="col-lg-12">
          <div class="card m-t-30">
            <div class="card-body p-2">
              <div class="row">
                <div class="col-lg-6">
                  <h3>Website logo and favicon</h3>
                  <div class="form-group">
                    <label for="main_logo">Update Upload Logo <span class="text-danger">(optional)</span></label>
                    <input type="file" class="form-control" name="main_logo">
                  </div>
                  <div class="form-group">
                    <label for="fav_icon">Update Upload Favicon <span class="text-danger">(optional)</span></label>
                    <input type="file" class="form-control" name="fav_icon">
                  </div>
                </div>
                <div class="col-lg-6">
                  <table style="margin-top: 60px">
                    <tr>
                      <td style="padding: 20px;">
                        <div class="form-group">
                          <img src="{{ asset('uploads/general/'.$edit->main_logo) }}" alt="website logo" width="120">
                        </div>
                      </td>

                    </tr>
                    <tr>
                      <td style="padding: 20px;">
                        <div class="form-group">
                          <img src="{{ asset('uploads/general/'.$edit->fav_icon) }}" alt="website logo" width="25">
                        </div>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
              <h3>Distribution Logo And Text</h3>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="distri_logo">Distribution Logo <span class="text-danger">(Optional)</span></label>
                    <input type="file" class="form-control" name="distri_logo">
                  </div>
                  <div class="form-group {{ $errors->has('distri_text') ? 'is-invalid' : '' }}">
                    <label for="distri_text">Distribution Text <span class="text-danger">(Required)</span></label>
                    <input type="text" class="form-control" name="distri_text" value="{{ $edit->distri_text }}">
                    <span class="text-danger">{{ $errors->has('distri_text') ? $errors->first('distri_text') : '' }}</span>
                  </div>
                </div>
                <div class="col-lg-6">
                  <img src="{{ asset('uploads/general/'.$edit->distri_logo) }}" alt="logo" class="img-fluid" width="80">
                </div>
              </div>
              <h3>Website siderbar menu 1</h3>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="side_title_1">Update Menu 1 title <span class="text-danger ">(required)</span></label>
                    <input type="text" class="form-control" name="side_title_1" value="{{ $edit->side_title_1 }}" id="side_title_1">
                  </div>
                  <div class="form-group">
                    <label for="side_icon_1">Update Sidebar Image <span class="text-danger">(optional)</span></label>
                    <input type="file" class="form-control" name="side_icon_1">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <img class="img" src="{{ asset('uploads/general/'.$edit->side_icon_1) }}" alt="side bar icon" width="50">
                  </div>
                </div>
              </div>
              <h3>Website siderbar menu 2</h3>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="side_title_2">Menu 2 title <span class="text-danger ">(required)</span></label>
                    <input type="text" class="form-control" name="side_title_2" value="{{ $edit->side_title_2 }}" id="side_title_2">
                  </div>
                  <div class="form-group">
                    <label for="side_icon_2">Update Sidebar Image</label>
                    <input type="file" class="form-control" name="side_icon_2">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <img class="img" src="{{ asset('uploads/general/'.$edit->side_icon_2) }}" alt="side bar icon" width="50">
                  </div>
                </div>
              </div>
              <h3>Website siderbar menu 3</h3>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="side_title_3">Menu 3 title <span class="text-danger ">(Required)</span></label>
                    <input type="text" class="form-control" name="side_title_3" value="{{ $edit->side_title_3 }}" id="side_title_3">
                  </div>
                  <div class="form-group">
                    <label for="side_icon_3">Update Sidebar Image <span class="text-danger">(optional)</span></label>
                    <input type="file" class="form-control" name="side_icon_3">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <img class="img" src="{{ asset('uploads/general/'.$edit->side_icon_3) }}" alt="side bar icon" width="50">
                  </div>
                </div>
              </div>
              {{--
              <h3>Website siderbar menu 4</h3>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="side_title_4">Menu 4 title <span class="text-danger ">(Required)</span></label>
                    <input type="text" class="form-control" name="side_title_4" value="{{ $edit->side_title_4 }}" id="side_title_4">
                  </div>
                  <div class="form-group">
                    <label for="side_icon_4">Update Sidebar Image <span class="text-danger ">(Optional)</span></label>
                    <input type="file" class="form-control" name="side_icon_4">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <img class="img" src="{{ asset('uploads/general/'.$edit->side_icon_4) }}" alt="side bar icon" width="50">
                  </div>
                </div>
              </div> --}}
              <h3>Website siderbar menu 4</h3>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="side_title_5">Menu 4 title <span class="text-danger ">(Required)</span></label>
                    <input type="text" class="form-control" name="side_title_5" value="{{ $edit->side_title_5 }}" id="side_title_5">
                  </div>
                  <div class="form-group">
                    <label for="side_icon_5">Update Sidebar Image <span class="text-danger ">(optional)</spa</label>
                    <input type="file" class="form-control" name="side_icon_5">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <img class="img" src="{{ asset('uploads/general/'.$edit->side_icon_5) }}" alt="side bar icon" width="50">
                  </div>
                </div>
              </div>
              <h3>Website siderbar menu 5</h3>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="side_title_6">Menu 5 title <span class="text-danger ">(Required)</span></label>
                    <input type="text" class="form-control" name="side_title_6" value="{{ $edit->side_title_6 }}" id="side_title_6">
                  </div>
                  <div class="form-group">
                    <label for="side_icon_6">Update Sidebar Image <span class="text-danger ">(optional)</spa</label>
                    <input type="file" class="form-control" name="side_icon_6">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <img class="img" src="{{ asset('uploads/general/'.$edit->side_icon_6) }}" alt="side bar icon" width="50">
                  </div>
                </div>
              </div>
              <h3>Website siderbar menu 6</h3>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="side_title_7">Menu 6 title <span class="text-danger ">(Required)</span></label>
                    <input type="text" class="form-control" name="side_title_7" value="{{ $edit->side_title_7 }}" id="side_title_7">
                  </div>
                  <div class="form-group">
                    <label for="side_icon_7">Update Sidebar Image <span class="text-danger ">(optional)</spa</label>
                    <input type="file" class="form-control" name="side_icon_7">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <img class="img" src="{{ asset('uploads/general/'.$edit->side_icon_7) }}" alt="side bar icon" width="50">
                  </div>
                </div>
              </div>
              <h3>Website siderbar menu 7</h3>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="side_title_8">Menu 7 title <span class="text-danger">(Required)</span></label>
                    <input type="text" class="form-control" name="side_title_8" value="{{ $edit->side_title_8 }}" id="side_title_8">
                  </div>
                  <div class="form-group">
                    <label for="side_icon_8">Update Sidebar Image <span class="text-danger ">(optional)</spa</label>
                    <input type="file" class="form-control" name="side_icon_8">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <img class="img" src="{{ asset('uploads/general/'.$edit->side_icon_8) }}" alt="side bar icon" width="50">
                  </div>
                </div>
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