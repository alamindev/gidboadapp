@extends('layouts/backend/layout') 
@section('title') Create New Permission
@endsection
 
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
      <h3 class="font-bold col-teal">Edit Permission</h3>
      <a href="{{ route('permissions.index') }}" class="btn  btn-raised bg-light-green waves-effect text-white button-item"> <i class="material-icons">chevron_left</i> &nbsp; <span class="text-capitalize font-bold">Back</span></a>
    </div>
    <!--end user heading -->

    <div class="row clearfix">
      <div class="col-lg-12">
        <form action="{{route('permissions.update', $permission->id)}}" method="POST">
          @csrf @method('PUT')
          <div class="card m-t-30">
            <div class="card-body p-2">
              <!--codign for permisssion type basic -->
              <div class="form-group {{ $errors->has('display_name') ? 'is-invalid' : '' }}">
                <label for="display_name">Name (Human Readable)</label>
                <input type="text" class="form-control" name="display_name" id="display_name" value="{{$permission->display_name}}">
                <span class="text-danger">{{ $errors->has('display_name') ? $errors->first('display_name') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('name') ? 'is-invalid' : '' }}">
                <label for="name">Slug <small class="text-danger">(Cannot be changed)</small></label>
                <input type="text" class="form-control" name="name" id="name" value="{{$permission->name}}" disabled>
                <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('description') ? 'is-invalid' : '' }}">
                <label for="description">Description  <span class="text-danger">(Optional)</span></label>
                <textarea name="description" id="description" cols="30" rows="5" class="control">
                   {{$permission->description}}
                </textarea>
                <span class="text-danger">{{ $errors->has('description') ? $errors->first('description') : '' }}</span>
              </div>
            </div>
          </div>
          <div class="card-header p-2">
            <input type="submit" value="save" class="btn  btn-raised bg-deep-purple waves-effect text-white">
          </div>
      </div>
      </form>
    </div>
    <!--end column-->
  </div>
  <!--end main row-->
  </div>
</section>
@endsection