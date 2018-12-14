@extends('frontend/layout') 
@section('title') Web app
@endsection
 
@section('main-content')
<!--start coding for main card-->
<vue-progress-bar></vue-progress-bar>
<div v-cloak>
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="power_manual">
        <div class="card  main-card">
          <div class="card-body">
            <p class="text-uppercase">Energy Generated</p>
            <p class="text-uppercase">@{{ calculated.total_power | currency(' ',0) }} <span>MW</span></p>
          </div>
        </div>
        <div class="card  main-card">
          <div class="card-body">
            <p class="text-uppercase">National Demand</p>
            @if(!empty($manual->national_demand))
            <p class="text-uppercase"> {{ number_format($manual->national_demand) }} <span>MW</span></p>
            @endif
          </div>
        </div>
        <div class="card  main-card">
          <div class="card-body">
            <p class="text-uppercase">Installed Capacity</p>
            @if(!empty($capacity))
            <p class="text-uppercase"> {{ number_format($capacity) }} <span>MW</span></p>
            @endif
          </div>
        </div>
        <div class="card  main-card">
          <div class="card-body">
            <p class="text-uppercase">Available Capacity</p>
            @if(!empty($manual->available_capacity))
            <p class="text-uppercase"> {{ number_format($manual->available_capacity) }} <span>MW</span></p>
            @endif
          </div>
        </div>
        <div class="card  main-card">
          <div class="card-body">
            <p class="text-uppercase">Transmission Capacity</p>
            @if(!empty($manual->transmission_capacity))
            <p class="text-uppercase"> {{ number_format($manual->transmission_capacity) }} <span>MW</span></p>
            @endif
          </div>
        </div>
      </div>
    </div>
    <!--end column-->
  </div>
  <!--end row-->

  <!--start coding for main area-->
  <div class="row" id="dextop">
    <div class="col-lg-6 col-md-6">
      <div class="card generation">
        <div class="card-header">
          GENERATION - FUEL TYPE
        </div>
        <div class="card-body">
          <div class="megawatt" v-for="(fueltype , index) in fuelTypes" :key="fueltype.id" @click="FuelShow(fueltype.id)" :class="checkIfClassActive(fueltype.id)">
            <table style="width: 100%" v-cloak>
              <tr class="main-energy">
                <td class="energy-icon">
                  <img :src="'uploads/fuel/'+ fueltype.logo" alt="Nuclear">
                </td>
                <td class="energy-title">
                  @{{ fueltype.name }}
                </td>
                <td class="energy-value">
                  <div class="nuclear_progress">
                    <div class="progress" v-cloak>
                      <div :style="{ background: fueltype.bg_color, width:(fueltype.power_plants[0].percent / fueltype.capacity).toFixed(1) + '%' }"
                        class="progress-bar" style="transition: width 3s" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                        aria-valuemax="100"></div>
                    </div>
                    <div class="progress_value" v-cloak>
                      <span class="percent" v-if="!fueltype.capacity == 0">@{{ (fueltype.power_plants[0].percent / fueltype.capacity).toFixed(1) }} %</span>
                      <span class="percent" v-if="fueltype.capacity == 0">0.0 %</span>
                      <span class="megaword" v-if="fueltype.power_plants[0].total"> @{{ fueltype.power_plants[0].total | currency(' ',0)}} MW</span>
                    </div>
                  </div>
                </td>
                <td class="energy-arrow">
                  <img src="{{ asset('images/icon-webapp-disclosure.png') }}" alt="Nuclear">
                </td>
              </tr>
            </table>
          </div>
          <div class="megawatt" @click="Distribution">
            <table style="width: 100%;">
              <tr class="export-main">
                <td class="export-img">
                  @if(!empty($distribution->distri_logo))
                  <img src="{{ asset('uploads/general/'.$distribution->distri_logo) }}" alt="distribution" data-no-retina="">                  @endif </td>
                <td class="export-title">
                  @if(!empty($distribution->distri_text)) {{ $distribution->distri_text }} @endif
                </td>
                <td class="export-arrow"><img src="{{ asset('images/icon-webapp-disclosure.png') }}" alt="Nuclear"></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!--end column-->
    <div class="col-lg-6 col-md-6">
      <!--generation one-->
      <div class="card generation" v-if="isActiveDistribution == false">
        <div class="card-header">
          GENERATION - Plant
        </div>
        <div class="card-body">
          <div class="view_side">
            <div class="power-head" :style="{ background: powerplant.bg_color }">
              <div class="title">
                <h3 class="text-white">@{{ powerplant.name }}</h3>
              </div>
              <div class="nuclear_progress">
                <div class="progress">
                  <div style=" background: #fff" :style="{ width: powerplant.percent + '%' }" class="progress-bar" role="progressbar" aria-valuenow="0"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="progress_value">
                  <span v-cloak class="percent text-white" v-if="!powerplant.total == 0">@{{ powerplant.percent }}% ( of total gird )</span>
                  <span v-cloak class="percent text-white" v-if="powerplant.total == 0">0.0% ( of total gird )</span>
                  <span v-cloak class="megaword text-white">  @{{ powerplant.output_total | currency(' ',0) }} MW</span>
                </div>
              </div>
            </div>
            <table class="table_head">
              <tbody>
                <tr v-cloak>
                  <td class="text-uppercase" :style="{ color: powerplant.bg_color }">Power Plant</td>
                  <td :style="{ color: powerplant.bg_color }">Output</td>
                  <td :style="{ color: powerplant.bg_color }">Capability</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="power-plant-main">
            <table class="power-plant">
              <tr v-cloak>
                <td style="font-size: 18px">Total</td>
                <td v-cloak style="font-size: 18px">@{{ powerplant.output_total | currency(' ',0) }}</td>
                <td v-cloak style="font-size: 18px">@{{ powerplant.cap_total | currency(' ',0) }}</td>
              </tr>
              <tr v-for="power in powerplant.powers" v-bind:key="power.id">
                <td>
                  <a v-cloak href="#" @click.prevent="ModalShow(power.id)">@{{ power.name }}</a>
                </td>
                <td v-cloak> @{{ power.output }}</td>
                <td v-cloak> @{{ power.capability }} </td>
              </tr>
            </table>
          </div>
          <!--view side-->
        </div>
        <!--emd card body-->
      </div>
      <!--end generagtion one-->
      <!--generation two-->
      <div class="card generation" v-if="isActiveDistribution == true">
        <div class="card-header text-uppercase">
          Distribution Overview (MW)
        </div>
        <div class="card-body">
          <div class="view_side">
            <!--end magawatt-->
            <div class="megawatt">
              <table style="width: 100%;">
                <tr class="export-main">
                  <td class="export-img" style="width: 15%; text-align: left;">
                    @if(!empty($distribution->distri_logo))
                    <img src="{{ asset('uploads/general/'.$distribution->distri_logo) }}" alt="distribution" data-no-retina="">                    @endif
                  </td>
                  <td class="export-title" style="text-align: left; width: 10%;">
                    Distribution Overview (MW)
                  </td>
                </tr>
              </table>
            </div>
            <table class="table_head">
              <tbody>
                <tr>
                  <td class="text-uppercase" style="width: 35%;">Disco</td>
                  <td>Demand</td>
                  <td>Received</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="power-plant-main">
            <table class="power-plant">
              <tr v-for="distribution in distributions" v-bind:key="distribution.id">
                <td style="width: 33%;">
                  <a href="#" @click.prevent="DistributionShow(distribution.id)">@{{ distribution.name }}</a>
                </td>
                <td>@{{ distribution.demand }}</td>
                <td>@{{ distribution.receive }} </td>
              </tr>
            </table>
          </div>
          <!--view side-->
        </div>
        <!--emd card body-->
      </div>
    </div>
    <!--end column-->
  </div>
  <!--end row-->
</div>
<!--end column-->
</div>
<!--end row-->
<!--start coding for main area mobile view style-->
<div class="row" id="mobile">
  <div class="col-lg-6 col-md-6">
    <div class="card generation">
      <div class="card-header">
        GENERATION - FUEL TYPE
      </div>
      <div class="card-body" v-cloak>
        <div class="megawatt" v-for="(fueltype , index) in fuelTypes" :key="fueltype.id" @click="FuelShowMobile(fueltype.id)" :class="checkIfClassActive(fueltype.id)">
          <table style="width: 100%">
            <tr class="main-energy">
              <td class="energy-icon">
                <img :src="'uploads/fuel/'+ fueltype.logo" a8lt="Nuclear" width="35">
              </td>
              <td class="energy-title">
                @{{ fueltype.name }}
              </td>
              <td class="energy-value">
                <div class="nuclear_progress" v-cloak>
                  <div class="progress" v-cloak>
                    <div :style="{ background: fueltype.bg_color, width:(fueltype.power_plants[0].percent / fueltype.capacity).toFixed(1) + '%' }"
                      class="progress-bar" style="transition: width 3s" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                      aria-valuemax="100"></div>
                  </div>
                  <div class="progress_value" v-cloak>
                    <span class="percent">@{{ (fueltype.power_plants[0].percent / fueltype.capacity).toFixed(1) }} %</span>
                    <span class="megaword" v-cloak v-if="fueltype.power_plants[0].total"> @{{ fueltype.power_plants[0].total | currency(' ',0)}} MW</span>
                  </div>
                </div>
              </td>
              <td class="energy-arrow">
                <img src="{{ asset('images/icon-webapp-disclosure.png') }}" alt="Nuclear">
              </td>
            </tr>
          </table>
        </div>
        <!--end magawatt-->
        <div class="megawatt" @click="Distribution">
          <table style="width: 100%;">
            <tr class="export-main">
              <td class="export-img">
                @if (!empty($distribution->distri_logo))
                <img src="{{ asset('uploads/general/'.$distribution->distri_logo) }}" alt="distribution" data-no-retina="">                @endif

              </td>

              <td class="export-title">
                @if (!empty($distribution->distri_text)) {{ $distribution->distri_text }} @endif
              </td>
              <td class="export-arrow"><img src="{{ asset('images/icon-webapp-disclosure.png') }}" alt="Nuclear"></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!--end column-->
  <div class="col-lg-6 col-md-6">
    <!--generation one-->
    <div :class="{  isResult:isResult}" class="card generation is_mobile_style">
      <div class="card-header text-uppercase time_arrow">
        <img src="{{ asset('images/icon-webapp-chevron-left.png') }}" data-no-retina="" @click="isMobileBack">
        <div class="time">
          2 NOv 1pm - 2pm
        </div>
      </div>
      <div class="card-body">
        <div class="view_side">
          <div class="power-head" :style="{ background: powerplant.bg_color }">
            <div class="title">
              <h3 class="text-white">@{{ powerplant.name }}</h3>
            </div>
            <div class="nuclear_progress">
              <div class="progress">
                <div style=" background: #fff" :style="{ width: powerplant.percent + '%' }" class="progress-bar" role="progressbar" aria-valuenow="0"
                  aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <div class="progress_value">
                <span class="percent text-white">@{{ powerplant.percent }}% ( of total gird )</span>
                <span class="megaword text-white">  @{{ powerplant.output_total | currency(' ',0) }} MW</span>
              </div>
            </div>
          </div>
          <table class="table_head">
            <tbody>
              <tr>
                <td class="text-uppercase" :style="{ color: powerplant.bg_color }">Power Plant</td>
                <td :style="{ color: powerplant.bg_color }">Output</td>
                <td :style="{ color: powerplant.bg_color }">Capability</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="power-plant-main">
          <table class="power-plant">
            <tr>
              <td style="font-size: 18px">Total</td>
              <td style="font-size: 18px">@{{ powerplant.output_total | currency(' ',0) }}</td>
              <td style="font-size: 18px">@{{ powerplant.cap_total | currency(' ',0) }}</td>
            </tr>
            <tr v-for="power in powerplant.powers" v-bind:key="power.id">
              <td>
                <a href="#" @click.prevent="ModalShow(power.id)">@{{ power.name }}</a>
              </td>
              <td>@{{ power.output }}</td>
              <td>@{{ power.capability }} </td>
            </tr>
          </table>
        </div>
        <!--view side-->
      </div>
      <!--emd card body-->
    </div>
    <!--generation two-->
    <div :class="{ isResult:isResult}" class="card generation is_mobile_style" v-if="isActiveDistribution == true">
      <div class="card-header text-uppercase time_arrow">
        <img src="{{ asset('images/icon-webapp-chevron-left.png') }}" data-no-retina="" @click="isMobileBack">
        <div class="time">
          2 NOv 1pm - 2pm
        </div>
      </div>
      <div class="card-body">
        <div class="view_side">
          <!--end magawatt-->
          <div class="megawatt">
            <table style="width: 100%;">
              <tr class="export-main">
                <td class="export-img" style="width: 15%; text-align: left;">
                  @if (!empty($distribution->distri_logo))
                  <img src="{{ asset('uploads/general/'.$distribution->distri_logo) }}" alt="distribution" data-no-retina=""></td>
                @endif
                <td class="export-title" style="text-align: left; width: 10%;">
                  Distribution Overview (MW)
                </td>
              </tr>
            </table>
          </div>
          <table class="table_head">
            <tbody>
              <tr>
                <td class="text-uppercase" style="width: 35%;">Disco</td>
                <td>Demand</td>
                <td>Received</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="power-plant-main">
          <table class="power-plant">
            <tr v-for="distribution in distributions" v-bind:key="distribution.id">
              <td style="width: 33%;">
                <a href="#" @click.prevent="ModalShow(distribution.id)">@{{ distribution.name }}</a>
              </td>
              <td>@{{ distribution.demand }}</td>
              <td>@{{ distribution.receive }} </td>
            </tr>
          </table>
        </div>
        <!--view side-->
      </div>
      <!--emd card body-->
    </div>
  </div>
  <!--end generagtion one-->
</div>
<!--end column-->
</div>
<!--end row-->
<!--===========================================
    coding for modal
  ============================================-->
<div class="modal fade" v-bind:class="showModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-capitalize" v-if="powerInfoPlant.name">@{{ powerInfoPlant.name }}</h5>
        <button type="button" class="close" @click="showModal = false">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body modal-custom">
        <div class="row">
          <div class="col-xl-12">
            <div class="main-popup">
              <div class="logo" v-if="powerInfo.logo != 'photo'">
                <img class="img-fluid" v-if="powerInfo.logo" :src="'uploads/power_info/' + powerInfo.logo" alt="Nuclear">
              </div>
              <div class="other_info">
                <div class="text_info">
                  <p v-html="powerInfo.info"></p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--end row-->
        <div class="row">
          <div class="col-xl-12">
            <div class="main-popup">
              <div class="map" id="map" style="width: 75%; padding-right: 30px;">
                <google-map :center="mainOptionMap" :zoom="mapZoom" map-type-id="terrain" style="width: 100%; height: 300px">
                  <gmap-custom-marker :marker="marker"> 
                  </gmap-custom-marker>
                </google-map>
              </div>
              <div class="other_info" v-if="powerInfo.twitter != null || powerInfo.youtube != null || powerInfo.facebook != null || powerInfo.website != null || powerInfo.address != null ||  powerInfo.email != null ||  powerInfo.phone != null || powerInfo.fax != null">
                <div class="link">
                  <h2>Contact</h2>
                  <ul class="link-ul">
                    <li v-if="powerInfo.address != null"> <strong>Address:</strong> @{{ powerInfo.address }}</li>
                    <li v-if="powerInfo.email != null"> <strong>Email:</strong> @{{ powerInfo.email }}</li>
                    <li v-if="powerInfo.phone != null"> <strong>Phone:</strong> @{{ powerInfo.phone }}</li>
                    <li v-if="powerInfo.fax != null"> <strong>Fax:</strong> @{{ powerInfo.fax }}</li>
                  </ul>
                  <ul class="social-link">
                    <li v-if="powerInfo.twitter != null">
                      <a :href="powerInfo.twitter" title="Go to Twitter"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li v-if="powerInfo.facebook != null">
                      <a :href="powerInfo.facebook" title="Go to Facebook"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li v-if="powerInfo.youtube != null">
                      <a :href="powerInfo.youtube" title="Go to Youtube"><i class="fa fa-youtube"></i></a>
                    </li>
                    <li v-if="powerInfo.website != null">
                      <a :href="powerInfo.website" title="Go to Website"><i class="fa fa-globe"></i></a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!--end column-->
        </div>
        <!--end row-->
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
      data:{
        fuelTypes: [],
        powerplant: {},  
        calculated: {}, 
        distributions: [],
        isActiveDistribution: false,
        showModal: '', 
        powerInfo: {},
        powerInfoPlant: {},
        showInfoPlant: false,
        marker: {
          lat: 0,
          lng: 0,
          icon: ''
        },
        mainOptionMap: {
          lat: 0,
          lng: 0
        },
        mapZoom: 0, 
        isLoading: false, 
        isResult: false
      }, 
    
      //all method
      methods: { 
         /*
          * method for Fetch All Fuel type
          */
        fetchData() { 
          this.$Progress.start()
          let url = "getfules";
          let vm = this;
          axios.get(url).then(res => { 
            this.fuelTypes  = res.data;  
            this.FuelShow(res.data[0].id);
            this.$Progress.finish();
          });
        },  
        fuelLoad(id){ this.FuelShow(id); },
         /*
          * method for show power plant by id
          */
        FuelShow(id){   
          this.$Progress.start()  
          this.isActiveDistribution = false;
          let url = "powerplant/" + id;
          let vm = this;
          axios.get(url).then(res => {
            this.powerplant = res.data;   
            this.$Progress.finish()
          });    
            this.powerplant.id = id;
        },
         /*
          * method for show power plant by id
          */
        FuelShowMobile(id){   
          this.$Progress.start()  
          this.isActiveDistribution = false;
          let url = "powerplant/" + id;
          let vm = this;
          axios.get(url).then(res => {
            this.powerplant = res.data;   
            this.$Progress.finish();  
            this.isResult = true;
          });     
        },
         /*
          * method for check active or not acive
          */
         checkIfClassActive(id) {
           if(this.isActiveDistribution == false){
                if (id === this.powerplant.id ) {
                   return 'isActive';
                 }
           }
            
          },
          /*
          * method for export import
          */
          Distribution(){ 
            this.$Progress.start()
               let url = "distribution";
                let vm = this;
                axios.get(url).then(res => {
                   this.distributions = res.data;  
                   this.isActiveDistribution = true;  
                   this.isResult = true;
                   this.$Progress.finish()
                   
                });     
          },
          /*
          * Calculated Power Generated, Ontario Demand, Total Emissions, CO2e Intensity
          */
          Calculated(){ 
            this.$Progress.start()
               let url = "calculation";
                let vm = this;
                axios.get(url).then(res => {
                   this.calculated = res.data[0];  
                   this.$Progress.finish()
                });     
          },
          /*
          * method for show modal
          */
         ModalShow(id){ 
            let url = "powerplant/info/" + id;
            let vm = this;
            axios.get(url).then(res => {
              this.powerInfo = res.data;  
              this.powerInfoPlant = res.data.power_plant; 
              this.marker.lat = res.data.lat; 
              this.marker.lng = res.data.lng; 
              this.marker.icon = res.data.fuels.map_icon; 
              this.mainOptionMap.lat = res.data.main_lat; 
              this.mainOptionMap.lng = res.data.main_lng; 
              this.mapZoom = res.data.zoom; 
              this.showModal = 'show';  
              
            });   
         },
         closeModal(){
           console.log('oke');
         },
         isMobileBack(){ 
            this.isResult = false;
         },
         /** 
          * coding for distribution show
          */
          DistributionShow(id){
            let url = "distribution/info/" + id;
            let vm = this;
            axios.get(url).then(res => { 
              this.powerInfo = res.data;   
              this.powerInfoPlant = res.data.distributions; 
              this.marker.lat = res.data.lat; 
              this.marker.lng = res.data.lng;  
              this.mainOptionMap.lat = res.data.main_lat; 
              this.mainOptionMap.lng = res.data.main_lng; 
              this.mapZoom = res.data.zoom; 
              this.showModal = 'show';   
            });   
          }
      },

       //for fetching data when page load
       created() {   
        this.fetchData();   
        this.Calculated();   
        }, 

    });

</script>











































































@endpush