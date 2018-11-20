@extends('layouts/backend/layout') 
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
      <h3 class="font-bold col-teal">Roles </h3>
      @permission('create-roles',Auth::user())
      <a href="{{ route('roles.create') }}" class="btn  btn-raised bg-light-green waves-effect text-white button-item"> <i class="material-icons">add_to_queue</i> &nbsp; <span  class="font-bold text-capitalize">Create Roles</span></a>      @endpermission
    </div>
    <!--end user heading -->
    <div class="row clearfix mt-5">
      @foreach ($roles as $role)
      <div class="col-lg-4">
        <div class="card top-report">
          <div class="body">
            <h2 class="title ml-4">{{$role->display_name}}</h2>
            <h4 class="subtitle  ml-4"><em>{{$role->name}}</em></h4>
            <p class=" ml-4">
              {{$role->description}}
            </p>
            <div class="button d-flex justify-content-between">
              @permission('read-roles',Auth::user())
              <a href="{{route('roles.show', $role->id)}}" class="btn  btn-raised bg-indigo waves-effect">Details</a> @endpermission
              @permission('update-roles',Auth::user())
              <a href="{{route('roles.edit', $role->id)}}" class="btn  btn-raised bg-teal waves-effect">Edit</a> @endpermission
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endsection