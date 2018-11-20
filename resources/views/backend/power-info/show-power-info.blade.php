@extends('layouts/backend/layout') 
@section('title') View Power Information
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
      <a href="{{ route('power-info.index') }}" class="btn  btn-raised bg-light-green waves-effect text-white button-item"> <i class="material-icons">add_to_queue</i> &nbsp; <span  class="font-bold text-capitalize">Back</span></a>
    </div>
    <!--end user heading -->
    <div class="row clearfix m-t-30">
      <div class="col-lg-12 ">
        <div class="card">
          <div class="body">
            <table class="table table-bordered  table-striped">
              <thead>
                <tr>
                  <th>Power Plant</th>
                  <td> :</td>
                  <td>
                    {{ $show->power_plant->name }}
                  </td>
                </tr>
                <tr>
                  <th>Power Information</th>
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
                <tr>
                  <th>Logo</th>
                  <td> :</td>
                  <td>
                    @if($show->logo == 'photo') no photo found @else
                    <img src="{{ asset('uploads/power_info/'.$show->logo) }}" alt="logo" class="img-fluid"> @endif
                  </td>
                </tr>
                @empty(!$show->address)
                <tr>
                  <th>Address</th>
                  <td> :</td>
                  <td>
                    {{ $show->address }}
                  </td>
                </tr>
                @endempty @empty(!$show->email)
                <tr>
                  <th>email</th>
                  <td> :</td>
                  <td>
                    {{ $show->email }}
                  </td>
                </tr>
                @endempty @empty(!$show->phone)
                <tr>
                  <th>phone</th>
                  <td> :</td>
                  <td>
                    {{ $show->phone }}
                  </td>
                </tr>
                @endempty @empty(!$show->fax)
                <tr>
                  <th>fax</th>
                  <td> :</td>
                  <td>
                    {{ $show->fax }}
                  </td>
                </tr>
                @endempty @empty(!$show->twitter)
                <tr>
                  <th>Twitter</th>
                  <td> :</td>
                  <td>
                    <a href="{{ $show->twitter }}" target="_blank">go to twitter</a>
                  </td>
                </tr>
                @endempty @empty(!$show->youtube)
                <tr>
                  <th>Youtube</th>
                  <td> :</td>
                  <td>
                    <a href="{{ $show->youtube }}" target="_blank">go to Youtube</a>
                  </td>
                </tr>
                @endempty @empty(!$show->facebook)
                <tr>
                  <th>facebook Link</th>
                  <td> :</td>
                  <td>
                    <a href="{{ $show->facebook }}" target="_blank">go to facebook</a>
                  </td>
                </tr>
                @endempty @empty(!$show->website)
                <tr>
                  <th>Website</th>
                  <td> :</td>
                  <td>
                    <a href="{{ $show->website }}" target="_blank">go to website</a>
                  </td>
                </tr>
                @endempty
                </tbody>
            </table>
          </div>
          <hr>
        </div>
      </div>
    </div>
</section>
@endsection