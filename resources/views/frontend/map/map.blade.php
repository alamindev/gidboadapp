@extends('frontend/layout') 
@section('title') Google map api
@endsection
 
@section('main-content')
  @include('frontend/_includes/right-side')
<!--start coding for main card-->
<div class="map" id="map">

  <google-map :center="mainOptionMap" :zoom="mapZoom" map-type-id="terrain" style="width: 100%; height: 92vh">
    <div v-for="marker in markers" :key="marker.id">
      <div v-for="map in marker.maps" :key="map.id">
        <gmap-custom-marker :marker="{ lat: map.lat, lng: map.lng  }">
          <img @click="mapPop(map.id)" v-show="marker.active" :src="'uploads/fuel/'+ marker.map_icon" alt="Nuclear" width="25">
        </gmap-custom-marker>
      </div>
    </div>
  </google-map>
</div>
<!--end row-->
<div class="modal fade" v-bind:class="{show : MapModal}">
  <div class="modal-dialog google-map" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-capitalize"> @{{ mapInfo.title }}</h5>
        <button type="button" class="close" @click="MapModal = false">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body map-custom">
        <p>@{{ mapInfo.info }}</p>
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
      markers:  [],
        mainOptionMap: {
          lat: 0,
          lng: 0
        },
        mapZoom: 0,   
        MapModal: false, 
      mapInfo : {}
   },
   methods:{
            /*
          * method for show modal
          */
         MapShow(){ 
            let url = "plant-map/fuel";
            let vm = this;
            axios.get(url).then(res => {  
                this.markers  = res.data;
            });   
         },
            /*
          * method for show modal
          */
         MapOption(){ 
            let url = "plant-map/option";
            let vm = this;
            axios.get(url).then(res => { 
               this.mainOptionMap.lat = res.data.main_lat
              this.mainOptionMap.lng = res.data.main_lng
              this.mapZoom = res.data.zoom  
            });   
         },
         removeMarker(index){ 
           let item = this.markers.filter(item => item.id == index )[0];
           this.isShow =  item.active = !item.active
         },
         mapPop(id){  
            let url = "plant-map/map/" + id;
            let vm = this;
            axios.get(url).then(res => {  
                this.mapInfo = res.data
                this.MapModal = true
            });   
            
         }
   },
    //for fetching data when page load
       created() { 
         this.MapShow(); 
         this.MapOption();
        }, 
 });

</script>






@endpush