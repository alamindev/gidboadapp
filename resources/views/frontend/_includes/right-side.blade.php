<div class="right-side" id="right-side-bar">
  <div class="main_right_side">
    <h4 class="title">filter by fuel type</h4>
    <ul class="fuel_type">
      <li v-for="(marker, index) in markers" :key="index" @click="removeMarker(marker.id)">
        <img :src="'uploads/fuel/'+ marker.logo" alt="Nuclear" class="filterImage">
        <span>@{{ marker.name }}</span>

        <img v-show="marker.active" v-bind:id="marker.id" src="{{ asset( 'images/icon-webapp-checkmark.png') }} " class="checkboxImage">
  </div>
  </li>
  </ul>

</div>
</div>