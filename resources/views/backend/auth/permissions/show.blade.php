@extends('layouts/backend/layout') 
@section('title') View Permission
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
      <h3 class="font-bold col-teal text-capitalize">view permission</h3>
      <a href="{{ route('permissions.index') }}" class="btn  btn-raised bg-light-green waves-effect text-white button-item"> <i class="material-icons">add_to_queue</i> &nbsp; <span  class="font-bold text-capitalize">Back</span></a>
    </div>
    <!--end user heading -->
    <div class="row clearfix">
      <div class="col-lg-12 m-t-30">
        <table id="datatable" class="table table-bordered  table-striped">
          <thead>
            <tr>
              <th>Id</th>
              <td> :</td>
              <td>{{ $permission->id }}</td>
            </tr>
            <tr>
              <th>Permission Name</th>
              <td> :</td>
              <td>{{ $permission->name }}</td>
            </tr>
            <tr>
              <th>Display Name</th>
              <td> :</td>
              <td>{{ $permission->display_name }}</td>
            </tr>
            <tr>
              <th>Description</th>
              <td> :</td>
              <td>{{ $permission->description }}</td>
            </tr>
            </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
@endsection