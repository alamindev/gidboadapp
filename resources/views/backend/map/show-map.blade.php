@extends('layouts/backend/layout') 
@section('title') View Map Information
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
      <h3 class="font-bold col-teal text-capitalize">View Information</h3>
      <a href="{{ route('map-info.index') }}" class="btn  btn-raised bg-light-green waves-effect text-white button-item"> <i class="material-icons">add_to_queue</i> &nbsp; <span  class="font-bold text-capitalize">Back</span></a>
    </div>
    <!--end user heading -->
    <div class="row clearfix m-t-30">
      <div class="col-lg-12 ">
        <div class="card">
          <div class="body">
            <table class="table table-bordered  table-striped">
              <thead>
                <tr>
                  <th>Fuel Type</th>
                  <td> :</td>
                  <td>
                    {{ $show->fuels->name }}
                  </td>
                </tr>
                <tr>
                  <th>Title</th>
                  <td> :</td>
                  <td>
                    {{ $show->title }}
                  </td>
                </tr>
                <tr>
                  <th>Map Information</th>
                  <td> :</td>
                  <td>{{ $show->info }}</td>
                </tr>
                <tr>
                  <th>Latitude</th>
                  <td> :</td>
                  <td>{{ $show->lat }}</td>
                </tr>
                <tr>
                  <th>Longitude</th>
                  <td> :</td>
                  <td>{{ $show->lng }}</td>
                </tr>
                </tbody>
            </table>
          </div>
          <hr>
        </div>
      </div>
    </div>
</section>
@endsection