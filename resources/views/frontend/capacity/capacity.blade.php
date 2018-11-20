@extends('frontend/layout') 
@section('title') Carbon and emissions
@endsection
 
@section('main-content')
<!--start coding for main card-->
<div class="row">
  <div class="col-lg-6">
    <div class="card generation_demand">
      <div class="card-header demand">INSTALLED CAPACITY</div>
      <div class="card-body column-box-body">
        <div class="ontario-capacity-chart-container">
          <div id="ontario-capacity-chart" style="padding: 0px; position: relative; display:flex; justify-content:center;">
            <pie-chart></pie-chart>
            <div class="ontario-capacity-chart-center-label">
              <span id="totalCapacity">{{ number_format($install_cap_sum) }}</span> MW<br> TOTAL
            </div>
          </div>
          <table class="ontario-capacity-table">
            <tbody class="ontario-capacity-table-body">
              @foreach($fuels as $fuel)
              <tr style="color: {{ $fuel->bg_color }}">
                <td class="ontario-capacity-source">{{ $fuel->name }}</td>
                <td class="ontario-capacity-value">{{ number_format($fuel->install_cap) }} MW</td>
                <td class="ontario-capacity-percentage">
                  @if($fuel->install_cap == 0) 0.0 % @else {{ round($fuel->install_cap * 100 / $fuel->total, 1) }} % @endif
                </td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <td colspan="3" class="ontario-capacity-date-updated">Last updated {{ $last_update }}</td>
              </tr>
            </tfoot>
          </table>
          <br> @if(!empty($capacity)) {!! $capacity->info_pie !!} @endif
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card generation_demand">
      <div class="card-header demand">SUPPLY MIX</div>
      <div class="card-body demand-body">
        <div class="demand_main">
          <div class="column-box-body">
            @if(!empty($capacity))
            <br> {!! $capacity->supply_mix !!} @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
 @push('scripts')
<script>
  var vm =  new Vue({
      el: '#app',
   data: {
    
   },
   methods:{
            /*
          * method for show modal
          */
        
   },
    //for fetching data when page load
       created() {  
        }, 
 });

</script>













































































@endpush