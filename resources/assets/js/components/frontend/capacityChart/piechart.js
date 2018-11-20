// CommitChart.js
import {
  Doughnut
} from 'vue-chartjs'

export default {
  extends: Doughnut,
  mounted() {
    let url = "total-capacity/chart";
    let vm = this;
    axios.get(url).then(res => {
      this.dataset = res.data
      this.renderPie()
    });
  }, // end mounted 
  data() {
    return {
      dataset: []
    }
  }, // end data
  methods: {
    renderPie() {
      this.renderChart({
        datasets: [this.dataset],
      }, {
        legend: {
          display: false,
        },
        responsive: true,
        maintainAspectRatio: false,
        cutoutPercentage: 80,
      }) //end chart render
    }
  }
} //end export default