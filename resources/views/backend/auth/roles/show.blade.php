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
      <h3 class="font-bold col-teal">View Role</h3>
      <a href="{{ route('roles.index') }}" class="btn  btn-raised bg-light-green waves-effect text-white button-item"> <i class="material-icons">add_to_queue</i> &nbsp; <span  class="font-bold text-capitalize">back</span></a>
    </div>
    <!--end user heading -->
    <div class="row clearfix mt-5">
      <div class="col-lg-12">
        <div class="card">
          <div class="body">
            <table id="datatable" class="table table-bordered  table-striped">
              <thead>
                <tr>
                  <th>Id</th>
                  <td> :</td>
                  <td>{{ $role->id }}</td>
                </tr>
                <tr>
                  <th>Permission Name</th>
                  <td> :</td>
                  <td>{{ $role->name }}</td>
                </tr>
                <tr>
                  <th>Display Name</th>
                  <td> :</td>
                  <td>{{ $role->display_name }}</td>
                </tr>
                <tr>
                  <th>Description</th>
                  <td> :</td>
                  <td>{{ $role->description }}</td>
                </tr>
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="body">
        <div class="row">
          <div class="col-lg-8">
            <h3 class="title">Permissions:</h3>
            <ul>
              @foreach ($role->permissions as $r)
              <li><span class="font-bold">{{ $r->display_name }}</span><em class="m-l-15">({{$r->description}})</em></li>
              @endforeach
            </ul>
          </div>
          <div class="col-lg-4">
            <h3 class="title">Users:</h3>
            <ul>
              @foreach ($role->users as $r)
              <li>{{$r->user_name}} <em class="m-l-15">({{$r->email}})</em></li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection