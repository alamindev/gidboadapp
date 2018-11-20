 <template> 
  <div class="chart">
      <chart-pie></chart-pie>
  </div>
 </template> 
 <script>
import pieChart from "./piechart";
export default {
  components: {
    "chart-pie": pieChart
  }
};
</script>

 <style>
.chart {
  width: 200px !important;
  height: 300px !important;
}
</style>
 