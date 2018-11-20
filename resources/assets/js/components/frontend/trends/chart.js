// CommitChart.js
import {
  Bar
} from 'vue-chartjs';

export default {
  extends: Bar,
  mounted() {
    let url = "todays-trends/tempfuel";
    let vm = this;
    axios.get(url).then(res => {
      this.dataset = res.data
      this.chartRender()
    });
  }, // end mounted 
  data() {
    return {
      dataset: []
    }
  },
  methods: {
    chartRender() {
      // Overwriting base render method with actual data.
      this.renderChart({
        labels: ['0:00', '', '3:00', '', '', '6:00', '', '', '9:00', '', '', '12:00', '', '', '15:00', '', '', '18:00', '', '', '21:00', '', '', '24:00'],
        datasets: this.dataset
      }, {
        legend: {
          display: false,
        },
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          xAxes: [{
            stacked: true,
            categoryPercentage: 0.5,
            barPercentage: 1.5
          }],
          yAxes: [{
            stacked: true,
            ticks: {
              suggestedMin: 50,
              suggestedMax: 30000,
              callback: function (label, index, labels) {
                if (label <= 1000) {
                  return label / 1000;
                } else {
                  return label / 1000 + 'k';
                }
              }
            }
          }],
        },
      }); //end chart render
    }
  }
} // end main export