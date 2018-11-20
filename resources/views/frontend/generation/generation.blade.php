@extends('frontend/layout') 
@section('title') generation and demand
@endsection
 
@section('main-content')
<!--start coding for main card-->
<div class="row">
  <div class="col-lg-6">
    <div class="card generation_demand">
      <div class="card-header demand"> Power Generated</div>
      <div class="card-body demand-body">
        <div class="demand_main">
          <p class="title_demand">The total amount of power Ontario <br> generated in megawatts (MW) for:</p>
          <h4 class="time">@{{ calculated.hour }}</h4>

          <div class="summary-box-summary-view-generation" style="background: url({{ asset('images/image-webapp-box-generation.png') }})">
            <div class="title">
              <p>POWER<br>GENERATED</p>
            </div>
            <div class="value">
              <p><span bind="powerGenerated">@{{ calculated.total_power | currency(' ',0) }}</span> MW</p>
            </div>
            <div class="value-level">
              <ul class="dimension">
                <li v-if="!(calculated.total_power < 16000)">LOW</li>
                <li v-if="(calculated.total_power < 16000)" style="color: #000">Low</li>
                <li v-if="(calculated.total_power >= 16000) && (calculated.total_power <= 20000)" style="color: #000">AVG</li>
                <li v-if="!((calculated.total_power >= 16000) && (calculated.total_power <= 20000))"> AVG</li>
                <li v-if="calculated.total_power > 20000" style="color: #000">High</li>
                <li v-if="!(calculated.total_power > 20000)">High</li>
              </ul>
            </div>
            <!-- End of value-level -->
          </div>
          <!--end summer text-->
          <div class="text-center mt-4">
            <img src="{{ asset('images/image-webapp-generation-context.png') }}" alt="generation context">
          </div>
          <div class="summary-box-entry-text">
            <br> 1 MW generated for 1 hour = 1MWh or 1,000 kWh
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card generation_demand">
      <div class="card-header demand">ONTARIO DEMAND</div>
      <div class="card-body demand-body">
        <div class="demand_main">
          <p class="title_demand">The amount of power in megawatts (MW)<br> to meet Ontario's electricity needs for:</p>
          <h4 class="time">@{{ calculated.hour }}</h4>

          <div class="summary-box-summary-view-generation" style="background: url({{ asset('images/image-webapp-box-demand.png') }})">
            <div class="title">
              <p>ONTARIO<br>DEMAND</p>
            </div>
            <div class="value">
              <p><span bind="powerGenerated">@{{ calculated.ontario_total | currency(' ',0) }}</span> MW</p>
            </div>
            <div class="value-level">
              <ul class="dimension">
                <li v-if="!(calculated.total_power < 15000)">LOW</li>
                <li v-if="(calculated.total_power < 15000)" style="color: #000">Low</li>
                <li v-if="(calculated.total_power >= 15000) && (calculated.total_power <= 19000)" style="color: #000">AVG</li>
                <li v-if="!((calculated.total_power >= 15000) && (calculated.total_power <= 19000))"> AVG</li>
                <li v-if="calculated.total_power > 19000" style="color: #000">High</li>
                <li v-if="!(calculated.total_power > 19000)">High</li>
              </ul>
            </div>
            <!-- End of value-level -->
          </div>
          <!--end summer text-->
          <table class="ontario-demand-table">
            <tbody style="border-bottom:1px solid #7d7d7d;">
              <tr>
                <td> Power Generated </td>
                <td style="text-align:right"> <span bind="powerGenerated">16,728</span> MW </td>
              </tr>
              <tr>
                <td> (plus) Imports </td>
                <td style="text-align:right"> <span bind="imports">125</span> MW </td>
              </tr>
              <tr>
                <td> (less) Exports </td>
                <td style="text-align:right"> <span bind="exports">1,963</span> MW </td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td style="padding: 5px 0;">Ontario Demand</td>
                <td style="text-align:right"><span bind="ontarioDemand">14,890</span> MW</td>
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
    calculated: {}
   },
   methods:{
      /*
          * Calculated Power Generated, Ontario Demand, Total Emissions, CO2e Intensity
          */
          Calculated(){  
               let url = "calculation";
                let vm = this;
                axios.get(url).then(res => {
                   this.calculated = res.data[0];   
                });     
          },
        
   },
    //for fetching data when page load
       created() {  
         this.Calculated();
        }, 
 });

</script>



















































































































@endpush