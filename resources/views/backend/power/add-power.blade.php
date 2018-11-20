@extends('layouts/backend/layout') 
@section('title') Powers
@endsection
 @push('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.css') }}"> 
@endpush 
@section('main-content')
<!-- Main Content -->

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
      <h3 class="font-bold col-teal">Add New Powers</h3>
      <a href="{{ route('powers.index') }}" class="btn  btn-raised bg-light-green waves-effect text-white button-item"> <i class="material-icons">chevron_left</i> &nbsp; <span class="text-capitalize font-bold">Back</span></a>
    </div>

    <!--end user heading -->
    <form action="{{ route('powers.store') }}" method="post">
      @csrf
      <div class="row clearfix">
        <div class="col-lg-12">
          <div class="card m-t-30">
            <div class="card-body p-2">
              <div class="form-group {{ $errors->has('per_table') ? 'is-invalid' : '' }}">
                <label for="display_name">Select Fuel Type</label>


                <select id="select2" name="fuel_id" class="form-control" style="width: 100%"> 
                                  <option value="">-- select Fuel Type --</option>
                                   @foreach($fuels as $fuels)  
                                      <option value="{{  $fuels->id }}">{{  $fuels->name }}</option>  
                                  @endforeach   
                      </select>

                <span class="text-danger">{{ $errors->has('fuel_id') ? $errors->first('fuel_id') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('name') ? 'is-invalid' : '' }}">
                <label for="name">Power Plant Name</label>
                <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Write Power Plant" id="name">
                <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('output') ? 'is-invalid' : '' }}">
                <label for="output">Output</label>
                <input type="text" class="form-control" name="output" value="{{old('output')}}" placeholder="example:- 555" id="output">
                <span class="text-danger">{{ $errors->has('output') ? $errors->first('output') : '' }}</span>
              </div>
              <div class="form-group {{ $errors->has('capability') ? 'is-invalid' : '' }}">
                <label for="capability">capability</label>
                <input type="text" class="form-control" name="capability" value="{{old('capability')}}" placeholder="example:- 555" id="capability">
                <span class="text-danger">{{ $errors->has('capability') ? $errors->first('capability') : '' }}</span>
              </div>
              <div class="form-group">
                <input type="submit" value="Save" class="btn btn-raised bg-light-green waves-effect text-white button-item">
              </div>
            </div>
            <!--end card body-->
          </div>
        </div>
        <!--end column-->
      </div>
      <!--end main row-->
    </form>
  </div>
</section>
@endsection
 @push('scripts')
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>

<script>
  $(function(){
      $('#select2').select2();
      
    });

</script>







@endpush