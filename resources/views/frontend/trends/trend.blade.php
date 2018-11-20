@extends('frontend/layout') 
@section('title') generation and demand
@endsection
 @push('styles') 
@endpush 
@section('main-content')

<!--start coding for main card-->
<div class="row" v-cloak>
  <div class="col-lg-12">
    <div class="card generation_demand">
      <div class="card-header demand">HOURLY GENERATION BY FUEL TYPE (MW)</div>
      <div class="card-body demand-body">
        <div class="demand_main">
          <div class="column-box-body" v-cloak>
            <bar-chart v-cloak></bar-chart>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
 @push('scripts')
<script>
  var app = new Vue({
        el: '#app', 
        data(){
          return {
            dataset: []
          } 
        }
    });

</script>











@endpush