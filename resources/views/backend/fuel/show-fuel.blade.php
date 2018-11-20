@extends('layouts/backend/layout') 
@section('title') View Fuel Information
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
      <h3 class="font-bold col-teal text-capitalize">View Fuel Information</h3>
      <a href="{{ route('fuels.index') }}" class="btn  btn-raised bg-light-green waves-effect text-white button-item"> <i class="material-icons">add_to_queue</i> &nbsp; <span  class="font-bold text-capitalize">Back</span></a>
    </div>
    <!--end user heading -->
    <div class="row clearfix m-t-30">
      <div class="col-lg-12 ">
        <div class="card">
          <div class="body">
            <table class="table table-bordered  table-striped">
              <thead>
                <tr>
                  <th>Id</th>
                  <td> :</td>
                  <td>
                    {{ $show->id }}
                  </td>
                </tr>
                <tr>
                  <th>capacity ( % )</th>
                  <td> :</td>
                  <td>
                    {{ $show->total }}
                  </td>
                </tr>
                <tr>
                  <th>install capacity</th>
                  <td> :</td>
                  <td>
                    {{ $show->install_cap }}
                  </td>
                </tr>
                <tr>
                  <th>capacity install date</th>
                  <td> :</td>
                  <td>
                    {{ $show->install_date }}
                  </td>
                </tr>
                <tr>
                  <th>Name</th>
                  <td> :</td>
                  <td>
                    {{ $show->name }}
                  </td>
                </tr>
                <tr>
                  <th>Background color</th>
                  <td> :</td>
                  <td>
                    <span style="width: 50px; height: 50px; background: {{ $show->bg_color }}; display:block;"></span>
                  </td>
                </tr>
                <tr>
                  <th>Logo</th>
                  <td> :</td>
                  <td>
                    <img src="{{ asset('uploads/fuel/'.$show->logo) }}" alt="{{ $show->name }}">
                  </td>
                </tr>
                <tr>
                  <th>Map Icon</th>
                  <td> :</td>
                  <td>
                    <img src="{{ asset('uploads/fuel/'.$show->map_icon) }}" alt="{{ $show->name }}">
                  </td>
                </tr>

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