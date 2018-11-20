@extends('layouts/backend/layout') 
@section('title') -::View User::-
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
      <h3 class="font-bold col-teal text-capitalize">View Information of {{ $show->user_name }}</h3>
      <a href="{{ route('users.index') }}" class="btn  btn-raised bg-light-green waves-effect text-white button-item"> <i class="material-icons">add_to_queue</i> &nbsp; <span  class="font-bold text-capitalize">Back</span></a>
    </div>
    <!--end user heading -->
    <div class="row clearfix m-t-30">
      <div class="col-lg-8 ">
        <div class="card">
          <div class="body">
            <table id="datatable" class="table table-bordered  table-striped">
              <thead>
                <tr>
                  <th>Id</th>
                  <td> :</td>
                  <td>{{ $show->id }}</td>
                </tr>
                <tr>
                  <th>First Name</th>
                  <td> :</td>
                  <td>{{ $show->first_name }}</td>
                </tr>
                <tr>
                  <th>Last Name</th>
                  <td> :</td>
                  <td>{{ $show->last_name }}</td>
                </tr>
                <tr>
                  <th>User Name</th>
                  <td> :</td>
                  <td>{{ $show->user_name }}</td>
                </tr>
                <tr>
                  <th>Email</th>
                  <td> :</td>
                  <td>{{ $show->email }}</td>
                </tr>
                <tr>
                  <th>Phone</th>
                  <td> :</td>
                  <td>{{ $show->phone }}</td>
                </tr>
                </tbody>
            </table>
          </div>
          <hr>
        </div>
        <div class="card m-t-30">
          <div class="body text-center">
            <img src="{{ asset('uploads/users/'.$show->photo) }}" alt="{{ $show->user_name }}" class="img-fluid">
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card">
          <div class="body">
            <h4 class="text-center">Your Roles</h4>
            <hr>
            <ul class="list-group">
              @foreach($show->roles as $role)
              <li class="list-group-item"> <b> {{ strToUpper($role->name) }}</b></li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection