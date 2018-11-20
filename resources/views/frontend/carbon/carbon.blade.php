@extends('frontend/layout') 
@section('title') Carbon and emissions
@endsection
 
@section('main-content')
<!--start coding for main card-->
<div class="row">
  <div class="col-lg-6">
    <div class="card generation_demand">
      <div class="card-header demand"> TOTAL EMISSIONS</div>
      <div class="card-body demand-body">
        <div class="demand_main">
          <p class="title_demand">Ontario's electricity grid emissions in <br>tonnes of carbon dioxide equivalent <br>(CO2e) that were produced during:</p>
          <h4 class="time">Sat Nov 3, 9 PM - 10 PM</h4>

          <div class="summary-box-summary-view-generation" style="background: url({{ asset('images/image-webapp-box-emissions.png') }})">
            <div class="title">
              <p>TOTAL<br>EMISSIONS</p>
            </div>
            <div class="value">
              <p><span bind="powerGenerated">16,728</span> tonnes</p>
            </div>
            <div class="value-level">
              <p>
                <span id="powerGeneratedLow" class="levelRange">LOW</span>
                <span id="powerGeneratedAvg" class="levelRange levelActivated">AVG</span>
                <span id="powerGeneratedHigh" class="levelRange">HIGH</span>
              </p>
            </div>
            <!-- End of value-level -->
          </div>
          <!--end summer text-->
          <div class="summary-box-entry-text">
            That's the same CO2e as:
            <br>
          </div>
          <div class="emissions-context">
            <div class="cars">
              <div class="value-level">
                <p><span id="carsValue" class="amount">145</span></p>
              </div>
            </div>
            <div class="trees">
              <div class="value-level">
                <p><span id="treesValue" class="amount">164,400</span></p>
              </div>
            </div>
          </div>
          <div class="text-center">
            <img src="{{ asset('images/image-webapp-emissions-context.png')}}" alt="emmisions">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card generation_demand">
      <div class="card-header demand">EMISSIONS INTENSITY</div>
      <div class="card-body demand-body">
        <div class="demand_main">
          <p class="title_demand">The amount of carbon emissions associated<br>with each kilowatt-hour (kWh) of electricity <br>generated in Ontario
            for:
          </p>
          <h4 class="time">Sat Nov 3, 9 PM - 10 PM</h4>

          <div class="summary-box-summary-view-generation" style="background: url({{ asset('images/image-webapp-box-intensity.png') }})">
            <div class="title">
              <p>CO2e<br>INTENSITY</p>
            </div>
            <div class="value">
              <p><span bind="powerGenerated">25</span> g/kWh</p>
            </div>
            <div class="value-level">
              <p>
                <span id="powerGeneratedLow" class="levelRange">LOW</span>
                <span id="powerGeneratedAvg" class="levelRange levelActivated">AVG</span>
                <span id="powerGeneratedHigh" class="levelRange">HIGH</span>
              </p>
            </div>
            <!-- End of value-level -->
          </div>
          <!--end summer text-->
          <div class="summary-box-entry-text">
            Carbon dioxide equivalent (CO2e) puts<br> greenhouse gasses (CO2, NO, CH4)<br> in terms of a unit of CO2.
          </div>
          <table class="ontario-demand-table">
            <tbody style="border-bottom: 1px solid #7d7d7d">
              <tr>
                <td> Power Generated </td>
                <td style="text-align:right"> <span bind="powerGenerated">16,488</span> MW </td>
              </tr>
              <tr>
                <td> Total CO2e </td>
                <td style="text-align:right"> <span bind="totalCo2e">411</span> t </td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td style="padding: 5px 0">g CO2e/kWh</td>
                <td style="text-align:right"><span bind="co2eIntensity">25</span> g</td>
              </tr>
            </tfoot>
          </table>
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