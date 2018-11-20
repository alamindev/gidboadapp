@extends('layouts/backend/layout') 
@section('title') Manuals Capacity
@endsection
 @push('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}"> 
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
      <h3 class="font-bold col-teal">Manuals Capacity </h3>
      @if(!App\ManualCap::count()) @permission('create-manuals',Auth::user())
      <a href="{{ route('manuals.create') }}" class="btn  btn-raised bg-light-green waves-effect text-white button-item"> <i class="material-icons">add_to_queue</i> &nbsp; <span  class="font-bold text-capitalize">Create</span></a>@endpermission
      @endif
    </div>
    <!--end user heading -->
    <div class="row clearfix">
      <div class="col-lg-12 m-t-30">
        <table id="datatable" class="table table-bordered  table-striped">
          <thead>
            <tr>
              <th>Serial</th>
              <th>national demand</th>
              <th>available capacity</th>
              <th>transmission capacity</th>
              <th>Manages</th>
            </tr>
          </thead>
          <tbody>
            @php $i=1; 
@endphp @foreach ($manuals as $data)
            <tr>
              <td>{{ $i++ }}</td>
              <td>{{$data->national_demand}}</td>
              <td>{{$data->available_capacity}}</td>
              <td>{{$data->transmission_capacity}}</td>
              <td class="has-text-right"> @permission('update-manuals',Auth::user())
                <a class="btn btn-raised bg-teal waves-effect btn-sm  ml-1" href="{{route('manuals.edit', $data->id)}}"><i class="far fa-edit text-white"></i></a>                @endpermission @permission('delete-manuals',Auth::user())
                <a class="btn btn-raised bg-pink waves-effect btn-sm  ml-1" href="{{route('manuals.delete', $data->id)}}" onclick="return confirm('Are you Sure')"><i class="fas fa-trash text-white"></i></a>                @endpermission
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
@endsection
 @push('scripts')
<script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>

<script type="text/javascript">
  $(function(){  
    //coding for dataTable
    $('#datatable').DataTable( {
      responsive: true, 
  });  
  });

</script>






























































































































































@endpush