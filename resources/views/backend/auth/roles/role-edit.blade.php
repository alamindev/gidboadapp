@extends('layouts/backend/layout') 
@section('title') Edit Role
@endsection
 @push('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.css') }}"> 
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
      <h3 class="font-bold col-teal">Edit Role</h3>
      <a href="{{ route('roles.index') }}" class="btn  btn-raised bg-light-green waves-effect text-white button-item"> <i class="material-icons">chevron_left</i> &nbsp; <span class="text-capitalize font-bold">Back</span></a>
    </div>

    <!--end user heading -->
    <form action="{{ route('roles.update',$edit->id) }}" method="post">
      @csrf @method('PUT')
      <div class="row clearfix">
        <div class="col-lg-4">
          <div class="card m-t-30">
            <div class="card-body p-2">
              <div class="form-group {{ $errors->has('display_name') ? 'is-invalid' : '' }}">
                <label for="display_name">Name (Human Readable)</label>
                <input type="text" class="form-control" name="display_name" value="{{ $edit->display_name }}" id="display_name">
                <span class="text-danger">{{ $errors->has('display_name') ? $errors->first('display_name') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('name') ? 'is-invalid' : '' }}">
                <label for="name">Slug (Can not be changed)</label>
                <input type="text" class="form-control" name="name" value="{{ $edit->name }}" id="name">
                <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('description') ? 'is-invalid' : '' }}">
                <label for="description">Description  <span class="text-danger">(Optional)</span></label>
                <textarea name="description" id="description" cols="30" rows="5" class="control">
                    {{ $edit->description }}
                </textarea>
                <span class="text-danger">{{ $errors->has('description') ? $errors->first('description') : '' }}</span>
              </div>
              <div class="form-group">
                <input type="submit" value="save" class="btn  btn-raised bg-deep-purple waves-effect text-white">
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <p class="text-capitalize m-t-20 text-danger">If you are not show permission then click below</p>
          <button type="button" class="btn  btn-raised bg-deep-purple waves-effect text-white" data-toggle="modal" data-target="#defaultModal"
            style="width: 100%">Add Permission Table</button>
          <div class="card ">
            <div class="body">
              <iv id="checkbox" class="check_all">
                <a href="#checkbox" id="btn-check-all" data-toggle="checkboxes" data-action="check" class="btn  btn-raised bg-deep-purple waves-effect">check all</a>
                <a href="#checkbox" class="btn  btn-raised bg-teal waves-effect" id="btn-check-all" data-toggle="checkboxes" data-action="uncheck">uncheck all</a>                @foreach($view_tables as $table)
                <ul style="margin: 15px 0">
                  <li style="width: 50%; float:left;list-style:none;">
                    <div id="{{ $table->t_name }}">
                      <label for="permission">Permission {{ $table->t_name }}</label>
                      <br>
                      <div class="d-flex">
                        <a href="#{{ $table->t_name }}" class="btn  btn-raised bg-blue waves-effect btn-sm" id="checkall" data-toggle="checkboxes"
                          data-action="check">check</a>
                        <a href="#{{ $table->t_name }}" class="btn  btn-raised bg-indigo waves-effect btn-sm" id="checkall" data-toggle="checkboxes"
                          data-action="uncheck">uncheck</a>
                      </div>
                      @php $value = $table->t_name; 
@endphp @foreach($permissions as $permission) @if($permission->per_table === $value)
                      <div class="demo-checkbox">
                        <input type="checkbox" id="{{ $permission->id }}" class="filled-in chk-col-red" name="permission[]" value="{{ $permission->id }}"
                          @foreach($edit->permissions as $data) @if($data->id == $permission->id) checked
                        @endif @endforeach />
                        <label for="{{ $permission->id }}">{{ $permission->display_name }}</label>
                      </div>
                      @endif @endforeach
                    </div>
                  </li>
                </ul>
                @endforeach
            </div>
          </div>
        </div>
      </div>
      <!--end column-->
  </div>
  <!--end main row-->
  </form>
  </div>
</section>
<!--for modal-->
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{ route('database_user_store') }}" method="post">
        @csrf
        <div class="modal-header">
          <h4 class="modal-title" id="defaultModalLabel">Show Permission Table</h4>
        </div>
        <div class="modal-body">
          <!--Permission table -->
          <div class="form-group">
            <label for="display_name"> Select Database Table </label>
            <select id="select2" name="per_table" class="form-control" style="width: 100%"> 
                  <option value="">-- Please select Table --</option>
                   @foreach($tables as $table)
                  @foreach ($table as $key => $value)  
                    @if($value !== 'password_resets' &&  $value !== 'migrations' && $value !== 'role_user' && $value !== 'permission_role' && $value !== 'permission_user'  && $value !== 'view_tables') 
                      <option value="{{  $value }}">{{  $value }}</option> 
                    @endif
                  @endforeach
                  @endforeach   
              </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn  btn-raised bg-deep-purple waves-effect text-white mr-2">SAVE CHANGES</button>
          <button type="button" class="btn  btn-raised bg-red waves-effect text-white" data-dismiss="modal">CLOSE</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
 @push('scripts')
<script src="{{ asset('assets/plugins/jquery.checkboxes-1.2.0.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript">
  $(function(){  
    $('#btn-check-all').on('click', function(e) {
      $('#checkbox').checkboxes('check');
      e.preventDefault();
    });
    $('#checkall').on('click', function(e) {
      $('#user_check').checkboxes('check');
      e.preventDefault();
    });
    $('#check_all').on('click', function(e) {
      $('#general,#country,#category,#counter').checkboxes('check');
      e.preventDefault();
    }); 
    $('#select2').select2();
    setTimeout(function(){ 
      $('#danger').fadeOut()
     }, 2000);
    setTimeout(function(){ 
      $('#success').fadeOut()
     }, 2000);

     
  });

</script>






























































@endpush