@extends('layouts/backend/layout') 
@section('title') -::Edit User::-
@endsection
 @push('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/dropzone/dropzone.css') }}"> 
@endpush 
@section('main-content')
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
      <h3 class="font-bold col-teal">Edit User Information Of {{ $edit->user_name }}</h3>
      <a href="{{ route('users.index') }}" class="btn  btn-raised bg-light-green waves-effect text-white button-item"> <i class="material-icons">chevron_left</i> &nbsp; <span class="text-capitalize font-bold">Back</span></a>
    </div>
    <!--end user heading -->
    <form action="{{ route('users.update',$edit->id) }}" method="post" enctype="multipart/form-data">
      @csrf @method('PUT')
      <div class="row clearfix">
        <div class="col-lg-7">
          <div class="card m-t-30">
            <div class="body">
              <div class="form-group">
                <label for="first_name">First Name <span class="text-danger">(Optional)</span></label>
                <input type="text" name="first_name" id="first_name" class="form-control" value="{{ $edit->first_name }}">
              </div>
              <div class="form-group">
                <label for="last_name">Last Name <span class="text-danger">(Optional)</span></label>
                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Write your last name" value="{{ $edit->last_name }}">
              </div>
              <div class="form-group {{ $errors->has('user_name') ? 'is-invalid' : '' }}">
                <label for="user_name">User Name <span class="text-danger">(Required)</span></label>
                <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Write your user name" value="{{ $edit->user_name }}">
                <span class="text-danger">{{ $errors->has('user_name') ? $errors->first('user_name') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('email') ? 'is-invalid' : '' }}">
                <label for="email">Email <span class="text-danger">(Required)</span></label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" value="{{ $edit->email }}">
                <span class="text-danger">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('phone') ? 'is-invalid' : '' }}">
                <label for="phone">Phone Number <span class="text-danger">(Required)</span></label>
                <input type="phone" name="phone" id="phone" class="form-control" placeholder="Phone Number" value="{{ $edit->phone }}">
                <span class="text-danger">{{ $errors->has('phone') ? $errors->first('phone') : '' }}</span>
              </div>
              <div class="demo-radio-button">
                <input name="group5" type="radio" id="radio_1" class="with-gap radio-col-red" name="auto_password" v-model="auto_password"
                  value="keep" />
                <label for="radio_1">Do Not change Password</label>
              </div>
              <div class="demo-radio-button">
                <input name="group5" type="radio" id="radio_2" class="with-gap radio-col-red" name="auto_password" v-model="auto_password"
                  value="auto" />
                <label for="radio_2">Auto Generate Password</label>
              </div>
              <div class="demo-radio-button">
                <input name="group5" type="radio" id="radio_3" class="with-gap radio-col-red" name="auto_password" v-model="auto_password"
                  value="manual" />
                <label for="radio_3">Manualy Give Password</label>
              </div>

              <div class="auto-generate " v-if="auto_password == 'manual'">
                <div class="form-group {{ $errors->has('password') ? 'is-invalid' : '' }}">
                  <label for="password">Password <span class="text-danger">(Required)</span></label>
                  <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                  <span class="text-danger">{{ $errors->has('password') ? $errors->first('password') : '' }}</span>
                </div>
                <div class="form-group">
                  <label for="password">Confirm Password <span class="text-danger">(Required)</span></label>
                  <input class="form-control {{$errors->has('password_confirmation') ? 'is-danger' : ''}}" type="password" name="password_confirmation"
                    id="password_confirmation" placeholder="confirm password" required>
                </div>
              </div>
              <div class="form-group">
                <input type="submit" value="save" class="btn  btn-raised bg-deep-purple waves-effect text-white">
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="card m-t-30">
            <div class="body">
              <img src="{{ asset('uploads/users/'.$edit->photo) }}" alt="{{ $edit->user_name }}" class="img-fluid">
              <hr>
              <photo-upload></photo-upload>
            </div>
          </div>
          <div class="card m-t-30">
            <div class="body  {{ $errors->has('roles') ? 'border-role' : '' }}">
              <h5 class="text-danger">Please Select At least one Roles :)- </h5>
              <div id="checkbox" class="check_all">
                <a href="#checkbox" id="btn-check-all" data-toggle="checkboxes" data-action="check" class="btn  btn-raised bg-deep-purple waves-effect">check all</a>
                <a href="#checkbox" class="btn  btn-raised bg-teal waves-effect" id="btn-check-all" data-toggle="checkboxes" data-action="uncheck">uncheck all</a>                @foreach($roles as $data)
                <div class="demo-checkbox mt-4">
                  <input type="checkbox" id="{{ $data->id }}" class="filled-in chk-col-red" name="roles[]" value="{{ $data->id }}" @foreach($edit->roles
                  as $role) @if($role->id == $data->id) checked @endif @endforeach />
                  <label for="{{ $data->id }}">{{ $data->display_name }}</label>
                </div>
                @endforeach
              </div>
              <span class="text-danger">{{ $errors->has('roles') ? $errors->first('roles') : '' }}</span>
            </div>
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
<script src="{{ asset('assets/plugins/jquery.checkboxes-1.2.0.min.js') }}"></script>
<script>
  var app = new Vue({
        el: '#app',
        data: {
          auto_password: 'manual',
        }
    });
 $(function(){
  $('#checkall').on('click', function(e) {
    $('#user_check').checkboxes('check');
    e.preventDefault();
  }); 
 })

</script>


























@endpush