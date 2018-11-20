require("./bootstrap");
window.Vue = require("vue");
import Vue2Filters from "vue2-filters";
import * as VueGoogleMaps from "vue2-google-maps";
import GmapCustomMarker from "vue2-gmap-custom-marker";
import VueProgressBar from 'vue-progressbar'
const options = {
  color: 'rgb(249, 149, 56)',
  failedColor: '#874b4b',
  thickness: '3px',
  transition: {
    speed: '0.2s',
    opacity: '0.6s',
    termination: 300
  },
}
Vue.use(VueProgressBar, options)
Vue.use(GmapCustomMarker);
Vue.use(Vue2Filters)
Vue.use(VueGoogleMaps, {
  load: {
    key: "AIzaSyDd40qP9Qll71WJ0IBZtUrtAs--klcYLNo",
    libraries: "places"
  }
});
/**
 *coding for component register
 */
Vue.component("photo-upload", require("./components/user/photoUpload.vue"));
Vue.component("bar-chart", require("./components/frontend/trends/barChart.vue"));
Vue.component("pie-chart", require("./components/frontend/capacityChart/pieChart.vue"));
Vue.component("google-map", VueGoogleMaps.Map);
Vue.component("gmap-custom-marker", GmapCustomMarker);
// coding for main