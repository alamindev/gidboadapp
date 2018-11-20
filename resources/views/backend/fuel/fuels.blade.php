@extends('layouts/backend/layout') 
@section('title') Fuels
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
      <h3 class="font-bold col-teal">Fuels </h3>
      @permission('create-fuels',Auth::user())
      <a href="{{ route('fuels.create') }}" class="btn  btn-raised bg-light-green waves-effect text-white button-item"> <i class="material-icons">add_to_queue</i> &nbsp; <span  class="font-bold text-capitalize">Create fuel</span></a>      @endpermission
    </div>
    <!--end user heading -->
    <div class="row clearfix">
      <div class="col-lg-12 m-t-30">
        <table id="datatable" class="table table-bordered  table-striped">
          <thead>
            <tr>
              <th>Serial</th>
              <th>capacity ( % )</th>
              <th>install capacity</th>
              <th>capacity install date</th>
              <th>Name</th>
              <th>Manages</th>
            </tr>
          </thead>
          <tbody>
            @php $i=1; 
@endphp @foreach ($fuels as $fuel)
            <tr>
              <td>{{ $i++ }}</td>
              <td>{{$fuel->total}}</td>
              <td>{{$fuel->install_cap}}</td>
              <td>{{$fuel->install_date}}</td>
              <td>{{$fuel->name}}</td>

              <td class="has-text-right">
                @permission('read-fuels',Auth::user())
                <a class="btn btn-raised bg-teal waves-effect btn-sm  ml-1" href="{{route('fuels.show', $fuel->id)}}"><i class="far fa-eye text-white"></i></a>                @endpermission @permission('update-fuels',Auth::user())
                <a class="btn btn-raised bg-teal waves-effect btn-sm  ml-1" href="{{route('fuels.edit', $fuel->id)}}"><i class="far fa-edit text-white"></i></a>                @endpermission @permission('delete-fuels',Auth::user())
                <a class="btn btn-raised bg-pink waves-effect btn-sm  ml-1" href="{{route('fuels.delete', $fuel->id)}}" onclick="return confirm('If you Delete Fuel then delete All Powerplant and powerinfo')"><i class="fas fa-trash text-white"></i></a>                @endpermission
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