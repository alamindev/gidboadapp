@extends('layouts/backend/layout') @push('styles')
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
      <h3 class="font-bold col-teal">User</h3>
      @permission('create-users', Auth::user())
      <a href="{{ route('users.create') }}" class="btn  btn-raised bg-light-green waves-effect text-white button-item"> <i class="material-icons">add_to_queue</i> &nbsp; <span  class="font-bold text-capitalize">Create User</span></a>      @endpermission
    </div>
    <!--end user heading -->
    <div class="row clearfix">
      <div class="col-lg-12">
        <table id="datatable" class="table table-bordered  table-striped">
          <thead>
            <tr>
              <th>id</th>
              <th>User Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Created Date</th>
              <th>Manage</th>
            </tr>
          </thead>
          <tbody>
            @php $i=1; 
@endphp @foreach($users as $user)
            <tr>
              <td>{{ $i++ }}</td>
              <td>{{ $user->user_name }}</td>
              <td>{{ $user->email}}</td>
              <td>{{ $user->phone }}</td>
              <td>{{ substr($user->created_at,0,10) }}</td>
              <td class="d-flex">
                @permission('read-users', Auth::user())
                <a class="btn btn-raised bg-indigo waves-effect btn-sm mr-1" href="{{route('users.show', $user->id)}}">
                      <i class="far fa-eye text-white"></i>
                    </a> @endpermission @permission('update-users', Auth::user())
                <a class="btn btn-raised bg-teal waves-effect btn-sm  mr-1" href="{{route('users.edit', $user->id)}}"><i class="far fa-edit text-white"></i></a>                @endpermission @permission('delete-users', Auth::user())
                <form method="POST" action="{{route('users.destroy', $user->id)}}">
                  @csrf @method('DELETE')
                  <button class="btn btn-raised bg-pink waves-effect btn-sm" type="submit" onclick="return confirm('Are You Sure!')"><i class="far fa-trash-alt text-white"></i></button>
                </form>
                @endpermission
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
<script src="{{ asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.flash.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>

<script type="text/javascript">
  $(function(){ 

    //coding for dataTable
    $('#datatable').DataTable( {
      responsive: true,
      dom: 'Bfrtip',
      buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
  });  
 
  });

</script>



































































































@endpush