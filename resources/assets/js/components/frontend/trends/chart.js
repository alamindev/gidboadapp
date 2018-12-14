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
        tooltips: {
          mode: 'label',
          backgroundColor: '#FFF',
          titleFontSize: 16,
          titleFontColor: '#333',
          bodyFontColor: '#000',
          bodyFontSize: 14, 
          borderWidth: 1,
          borderColor: '#000',
          bodySpacing: 10, 
          titleMarginBottom: 15,
          xPadding: 15, 
          callbacks: {
            title: function (tooltipItem, data) {  
              // console.log(data.datasets[0].backup[0].created_at);
              var event = new Date(data.datasets[0].backup[0].created_at);
              var eventSub =  event.toString().substr( 0,  10 ); 
              var timeArray = [' 0:00-1:00',' 1:00-2:00',' 2:00-3:00',' 3:00-4:00',' 4:00-5:00',' 5:00-6:00',' 6:00-7:00',' 7:00-8:00',' 8:00-9:00',' 10:00-11:00',' 11:00-12:00',' 12:00-13:00',' 13:00-14:00',' 14:00-15:00',' 15:00-16:00',' 16:00-17:00',' 17:00-18:00',' 18:00-19:00',' 19:00-20:00',' 20:00-21:00',' 21:00-22:00',' 22:00-23:00',' 23:00-24:00']; 
              return eventSub  +  timeArray[ tooltipItem[0].index ]; 
            }, 
            label: function(tooltipItem, data) { 
                  var corporation = data.datasets[tooltipItem.datasetIndex].name; 
                  var valor = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index] + ' MW'; 
                  var total = 0;
                  for (var i = 0; i < data.datasets.length; i++)  
                      if (tooltipItem.datasetIndex != data.datasets.length - 1) {
                        return corporation + " : " + valor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    } else {
                        return [corporation + " : " + valor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")];
                    }
                  }, 
            }
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