<div class="right-side" id="right-side-bar">
  <div class="main_right_side">
    <h4 class="title">filter by fuel type</h4>
    <ul class="fuel_type">
      <li v-for="(fuel, index) in dataset" :key="index" @click="removeBar(fuel.id)">
        <img :src="'uploads/fuel/'+ fuel.logo" alt="Nuclear" class="filterImage">
        <span>@{{ fuel.name }}</span>

        <img v-bind:id="fuel.id" src="{{ asset( 'images/icon-webapp-checkmark.png') }} " class="checkboxImage">
  </div>
  </li>
  </ul>

</div>
</div>