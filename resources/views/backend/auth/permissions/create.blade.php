@extends('layouts/backend/layout') 
@section('title') Create New Permission
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
      <h3 class="font-bold col-teal">Create New Permission</h3>
      <a href="{{ route('permissions.index') }}" class="btn  btn-raised bg-light-green waves-effect text-white button-item"> <i class="material-icons">chevron_left</i> &nbsp; <span class="text-capitalize font-bold">Back</span></a>
    </div>
    <!--end user heading -->

    <div class="row clearfix">
      <div class="col-lg-12">

        <form action="{{ route('permissions.store') }}" method="post">
          @csrf
          <div class="card m-t-30">
            <div class="card-header p-2">
              <div class="demo-radio-button">
                <input v-model="permissionType" name="permission_type" value="basic" type="radio" id="radio_30" class="with-gap radio-col-red"
                  checked />
                <label for="radio_30">Basic Permission</label>

                <input v-model="permissionType" name="permission_type" value="crud" type="radio" id="radio_31" class="with-gap radio-col-pink"
                />
                <label for="radio_31">CRUD Permission</label>
              </div>
            </div>
            <div class="card-body p-2">
              <!--Permission table -->
              <div class="form-group {{ $errors->has('per_table') ? 'is-invalid' : '' }}">
                <label for="display_name">Select Database Table</label>


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

                <span class="text-danger">{{ $errors->has('per_table') ? $errors->first('per_table') : '' }}</span>
              </div>

              <!--codign for permisssion type basic -->
              <div class="form-group {{ $errors->has('display_name') ? 'is-invalid' : '' }}" v-if="permissionType == 'basic'">
                <label for="display_name">Name (Human Readable)</label>
                <input type="text" class="form-control" name="display_name" value="{{old('display_name')}}" id="display_name">
                <span class="text-danger">{{ $errors->has('display_name') ? $errors->first('display_name') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('name') ? 'is-invalid' : '' }}" v-if="permissionType == 'basic'">
                <label for="name">Slug (Can not be changed)</label>
                <input type="text" class="form-control" name="name" value="{{old('name')}}" id="name">
                <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('description') ? 'is-invalid' : '' }}" v-if="permissionType == 'basic'">
                <label for="description">Description  <span class="text-danger">(Optional)</span></label>
                <textarea name="description" id="description" cols="30" rows="5" class="control">
                  {{ old('description') }}  
                </textarea>
                <span class="text-danger">{{ $errors->has('description') ? $errors->first('description') : '' }}</span>
              </div>

              <!--codign for permisssion type crud -->
              <div class="form-group {{ $errors->has('resource') ? 'is-invalid' : '' }}" v-if="permissionType == 'crud'">
                <label for="description">Resource</label>
                <input type="text" class="form-control" name="resource" id="resource" v-model="resource" placeholder="The name of the resource"
                  value="{{ old('resource') }}">
                <span class="text-danger">{{ $errors->has('resource') ? $errors->first('resource') : '' }}</span>
              </div>
              <div class="row" v-if="permissionType == 'crud'">
                <div class="col-lg-4">
                  <div class="demo-checkbox">
                    <input type="checkbox" id="md_checkbox_1" class="chk-col-red" v-model="crudSelected" v-model="crudSelected" value="create"
                    />
                    <label for="md_checkbox_1">Create </label>
                  </div>
                  <div class="demo-checkbox">
                    <input type="checkbox" id="md_checkbox_2" class="chk-col-brown" v-model="crudSelected" v-model="crudSelected" value="read"
                    />
                    <label for="md_checkbox_2">Read </label>
                  </div>
                  <div class="demo-checkbox">
                    <input type="checkbox" id="md_checkbox_3" class="chk-col-purple" v-model="crudSelected" value="update" />
                    <label for="md_checkbox_3">Update</label>
                  </div>
                  <div class="demo-checkbox">
                    <input type="checkbox" id="md_checkbox_4" class="chk-col-gray" v-model="crudSelected" value="delete" />
                    <label for="md_checkbox_4">delete</label>
                  </div>
                </div>

                <div class="col-lg-8">
                  <input type="hidden" name="crud_selected" :value="crudSelected">
                  <table class="table" v-if="resource.length >= 3 && crudSelected.length > 0">
                    <thead>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Description</th>
                    </thead>
                    <tbody>
                      <tr v-for="item in crudSelected">
                        <td v-text="crudName(item)"></td>
                        <td v-text="crudSlug(item)"></td>
                        <td v-text="crudDescription(item)"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="card-header p-2">
            <input type="submit" value="save" class="btn  btn-raised bg-deep-purple waves-effect text-white">
          </div>
      </div>
      </form>
    </div>
    <!--end column-->
  </div>
  <!--end main row-->
  </div>
</section>
@endsection
 @push('scripts')
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script>
  var app = new Vue({
      el: '#app',
      data: {
        permissionType: 'basic',
        resource: '',
        crudSelected: ['create', 'read', 'update', 'delete']
      },
      methods: {
        crudName: function(item) {
          return item.substr(0,1).toUpperCase() + item.substr(1) + " " + app.resource.substr(0,1).toUpperCase() + app.resource.substr(1);
        },
        crudSlug: function(item) {
          return item.toLowerCase() + "-" + app.resource.toLowerCase();
        },
        crudDescription: function(item) {
          return "Allow a User to " + item.toUpperCase() + " a " + app.resource.substr(0,1).toUpperCase() + app.resource.substr(1);
        }
      }
    });
    $(function(){
      $('#select2').select2();
      
    });

</script>












































@endpush