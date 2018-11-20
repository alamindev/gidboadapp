@extends('frontend/layout') 
@section('title') Help & about
@endsection
 @push('styles')
<style>
  .gridwatch-block-help-about-lg {
    width: 100%;
    height: 668px;
    float: left;
    position: relative;
    margin-top: 10px;
    margin-bottom: 10px;
    background: #ffffff;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    -webkit-overflow-scrolling: touch;
  }

  .gridwatch-block-help-about-header-lg {
    height: 40px;
    font-size: 16px;
    padding: 10px;
    margin-bottom: 10px;
    border-bottom: 1pt solid #efeff4;
  }

  .column-box-body-help-about-lg {
    text-align: left;
    font-size: 14px;
    padding-left: 10px;
    padding-right: 10px;
    margin: auto;
    height: 610px;
    overflow-y: auto;
  }
</style>






@endpush 
@section('main-content')
<!--start coding for main card-->
<div class="row">
  <div class="col-lg-6">
    <div class="gridwatch-block-help-about-lg">
      <div class="gridwatch-block-help-about-header-lg">
        HELP &amp; HOW TO
      </div>
      <div class="column-box-body-help-about-lg">
        <br>
        <h3>POWER GENERATED</h3>
        <p>The total power Ontario generated in MW for the most recent full hour is displayed on the left. Ontario's demand
          in MW is shown on the right. Below each is an indicator if the amount is considered LOW AVG or HIGH. Additional
          details for both are provided in the generation and demand section.</p>
        <div class="text-center"><img src="{{ asset('images/') }}/image-info-homeview-power.png"></div>
        <br>
        <br>
        <h3>CARBON EMISSIONS</h3>
        <p>The total carbon emissions for the most recent full hour is displayed on the left. The carbon intensity per kWh is
          shown on the right. Below each is an indicator if the amount is considered LOW AVG or HIGH. Additional details
          for both are provided in the carbon emissions section.</p>
        <div class="text-center"><img src="{{ asset('images/') }}/image-info-homeview-emissions.png"></div>
        <br>
        <br>
        <h3>REFRESHING DATA</h3>
        <p>Gridwatch refreshes the data automatically every time the app is opened. Refresh your browser or tap the refresh
          icon at the top right to fetch the latest data. The IESO normally publishes generation data 40 minutes past the
          hour for the most recent full hour (example: at 2:40pm, data for 1-2pm will be available and display in the app).
          If no new data is available, the app will display the most recent data available.</p>
        <br>
        <h3>FUEL TYPE DRILL DOWN</h3>
        <p>To see which generation stations have supplied power to the grid during the most recent full hour, tap a fuel type
          from the list. Total output and capacity values are listed at the top. The output column lists the amount of electricity
          each station has injected into the grid for the most recent full hour. The capacity column lists the amount of
          electricity that each station can potentially generate. When the capacity value is zero, the generating station
          is either offline or experiencing a planned outage. On smaller screens, return to the home screen by tapping the
          "back" button.</p> <br>
        <div class="text-center"><img src="{{ asset('images/') }}/image-info-fueltype.png"></div>
        <br>
        <br>
        <h3>POWER PLANT DETAILS</h3>
        <p>To see details about an individual plant and its location, tap on the plant name from the list.</p>
        <br>
        <div class="text-center"><img src="{{ asset('images/') }}/image-info-plant.png"></div>
        <br>
        <br>
        <h3>PLANT MAP</h3>
        <p>The interactive Plant Map shows the physical location of each generating station with the ability to filter by fuel
          type. Use the fuel type icons inside the filter menu to view the different fuel types. To view details about individual
          plants, tap on the location pin and the plant name will appear in a pop-up.</p>
        <br>
        <h3>TOTAL CAPACITY</h3>
        <p>The Total Mix section shows the total installed generating capacity of the grid broken down by fuel type. Figures
          are based on the most recent IESO published data available.</p>
        <br>
        <h3>HOW THE GRID WORKS</h3>
        <p>Swipe through this section and learn about how the electricity grid works from generation to the future of the smart
          grid.
        </p>
        <br>
        <h3>CO2e EMISSIONS GRAPH</h3>
        <p>The values will fill in throughout the day as data becomes available. The Y-axis shows total emissions in tonnes
          of CO2 equivalent (example 2k = 2,000 tonnes of emissions). The time of day is displayed along the X-axis.</p>
        <br>
        <h3>POWER GENERATED GRAPH</h3>
        <p>The values will fill in throughout the day as data becomes available. The Y-axis shows the amount of electricity
          generated in thousands of megawatts (example: 5k = 5000 megawatts). The X-axis lists the time of day. The bars
          in the graph are broken into coloured sections. Each colour corresponds to a generation type. Orange is nuclear,
          blue is hydro, purple is natural gas, black is coal, and green is wind. All other generation types (combined heat
          and power, wood, oil, bio-mass) are red. Click or tap anywhere on the bars for full details of that hour.</p>
        <br>
        <h3>FILTERING BY FUEL TYPE</h3>
        <p>Click or tap the filter icon at the top right of the menu bar and use the icons on the right to interact with the
          graphs. Hide a generation type by tapping on its icon. To show it again (checkmark), tap on the icon once more.
          When hiding different fuel types, a shadow of the total generation and CO2e will remain as a reference.</p>
        <br>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="gridwatch-block-help-about-lg">
      <div class="gridwatch-block-help-about-header-lg">
        ABOUT GRIDWATCH
      </div>
      <div class="column-box-body-help-about-lg">
        <br>
        <h3>THE WEB APP</h3>
        <p>Power Generation, CO2e and plant information are all provided for informational purposes only. Gridwatch is © 2014,
          EnergyMobile Studios Inc. All rights reserved.</p>
        <br>
        <h3>ABOUT THE DEVELOPER</h3>
        <br>
        <div class="text-center"><img src="{{ asset('images/') }}/image-info-company.png"></div>
        <br>
        <p>Based in Ottawa, Ontario, EnergyMobile Studios builds beautiful apps that help simplify and save energy for consumers.
          The company was founded in 2011 with the goal of improving consumer energy literacy using emerging technology and
          great design.
        </p>
        <p>Find out about our planned updates, get help and support or drop us a line with your feedback or suggestions.</p>
        <p><a href="http//gridwatch.ca" target="_blank">gridwatch.ca</a></p>
        <p><a href="http//twitter.com/Energy_Mobile" target="_blank">@Energy_Mobile</a></p>
        <p><a href="http//facebook.com/EnergyMobile" target="_blank">EnergyMobile on Facebook</a></p>
        <p><a href="mailto:gridwatch@energymobile.ca">gridwatch@energymobile.ca</a></p>
        <br>
        <h3>POWER GENERATED DATA</h3>
        <p>Ontario’s Independent Electricity Systems Operator <a href="http://ieso.ca" target="_blank">IESO</a> makes publicly
          available the power generated data, plant capability and hourly outputs for each generating unit over 20 MW that
          is connected to the transmission grid. Electricity imports and exports are excluded from the Power Generated values
          and shown separately in the app.</p>
        <br>
        <h3>POWER PLANT INFORMATION</h3>
        <p>Individual power plant information is from publicly available sources <a href="http://ieso.ca" target="_blank">IESO</a>,
          <a href="http://carma.org" target="_blank">Carma.org</a> and others. Map locations shown are approximate</p>
        <br>
        <h3>CARBON EMISSIONS</h3>
        <p>Emissions factors used to calculate the total hourly emissions and emissions intensity are taken from a peer reviewed
          study conducted by Niagara College’s Research and Innovation Division.</p>
        <p>CO2e intensity values were calculated for coal, natural gas and oil generation. Emission-free generation sources
          include nuclear, solar, hydro, biomass, wood and wind. Each generating facility is treated separately and assigned
          it’s own emissions factor when calculating the total for the hour.</p>
        <br>
        <h3>HOMES, TREES and CARS</h3>
        <p>The average Ontario household consumes about 1,000 kilowatt-hours (kWh) per month.The average passenger vehicle emits
          2.8 tonnes of CO2 per year (15,000km travelled, 8L/100km efficiency)
          <br>Sources:
          <br><a href="http://ontarioenergyboard.ca/OEB/Consumers" target="_blank">Ontario Energy Board
      								<br></a><a href="http://hydroone.com/TOU/Pages/MyBillExplained.aspx" target="_blank">Hydro One</a>
        </p>
        <p>The average Canadian tree absorbs 200kg of CO2 over 80 years (2.5kg/tree/year).
          <br>Source:
          <br><a href="http://treecanada.ca" target="_blank">Tree Canada</a>
        </p>
        <br>
        <div class="text-center"><img src="{{ asset('images/') }}/image-info-hometreecar.png"></div>
        <br>
        <br>
        <h3>CONTRIBUTOR - NIAGARA COLLEGE</h3>
        <p>Emission intensity values are taken from a study authored by lead researcher, Kurt Frommann, and conducted through
          <a href="http://niagaracollege.ca/research/" target="_blank">Niagara College’s</a> Research and Innovation Division.
          The study, entitled "Hourly Emission Factors for the Consumption of Purchased Electricity within a Specific Power
          Market (2011)", describes a peer-reviewed method of calculating hourly emission factors. It uses Ontario as a model.
        </p>
        <br>
        <div class="text-center"><img src="{{ asset('images/') }}/image-info-niagara.png"></div>
        <br>
        <br>
        <h3>CONTRIBUTOR - e3 SOLUTIONS INC.</h3>
        <p><a href="http://e3solutionsinc.com" target="_blank">e3 Solutions Inc.</a> was the lead industry partner for the Niagara
          College study. e3 Solutions Inc. helps companies, educational institutions, climate action groups, and government
          agencies measure, monitor, and verify their greenhouse gas emissions with state-of-the-art software.
        </p>
        <br>
        <div class="text-center"><img src="{{ asset('images/') }}/image-info-e3solutions.png"></div>
        <br>
        <br>
      </div>
    </div>
  </div>
</div>
@endsection