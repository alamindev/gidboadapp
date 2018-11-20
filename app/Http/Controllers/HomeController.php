<?php

namespace App\Http\Controllers;

use App\Map;
use App\Fuel;
use App\Temp;
use App\Backup;
use App\Slider;
use App\TotalCap;
use App\MapOption;
use App\General;
use App\PowerInfo;
use Carbon\Carbon;
use App\PowerPlant;
use App\Distribution;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\ManualCap;

class HomeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $powerPlants = PowerPlant::latest('updated_at')->select('updated_at')->first();
        if ($powerPlants) {
            $addhour = Carbon::parse($powerPlants->updated_at)->addHour(1)->format('g A');
            $carbon = Carbon::parse($powerPlants->updated_at)->format('D M j, g A');
            $hour = $carbon . " - " . $addhour;
            $manual = ManualCap::first();
            $capacity = Fuel::sum('install_cap');
           $distribution = General::select('distri_logo','distri_text')->first();
            return view('frontend.home.home', compact('hour', 'manual', 'capacity','distribution'));
        }
    }

    /**
     *
     * show fuels
     *
     */

    public function getFuels()
    {
        $fuels = Fuel::with('power_plants')
            ->select('id', 'total as capacity', 'bg_color', 'logo', 'name')
            ->get();
        return response()->json($fuels)->setEncodingOptions(JSON_NUMERIC_CHECK);
    }
    /**
     *
     * show Power plant by id
     *
     */

    public function getPowerPlant($id)
    {
        $output = PowerPlant::where('fuel_id', $id)->sum('output');
        $capability = PowerPlant::where('fuel_id', $id)->sum('capability');
        $percent = PowerPlant::where('fuel_id', $id)->sum('output') * 100;  
        $fuel = Fuel::with('powers')->select('id', 'total', 'bg_color', 'name')->where('id', $id)->first();
        if($fuel->total == 0){
              $divide = 1;
                $percent = round($percent / $divide, 1);
                $collection = collect($fuel);
        }else{
            $divide = $fuel->total;
                if ($divide !== 0) {
                    $percent = round($percent / $divide, 1);
                }
                $collection = collect($fuel);
        }
        $collections = $collection->merge(['output_total' => $output, 'cap_total' => $capability, 'percent' => $percent]);
        return response()->json($collections)->setEncodingOptions(JSON_NUMERIC_CHECK);
    }
    /**
     *
     * show export import
     *
     */

    public function Distribution()
    {
        $Distribution = Distribution::orderBy('updated_at', 'DESC')->select('id', 'name', 'demand', 'receive')->get();
        return response()->json($Distribution)->setEncodingOptions(JSON_NUMERIC_CHECK);
    }
    /**
     *
     * show Power plant info by id
     *
     */

    public function PowerPlantInfo($id)
    {
        $powerinfo = PowerInfo::where('power_id', $id)->first();
        $fuel = PowerPlant::where('fuel_id', $powerinfo->power_plant->fuel_id)
            ->with('fuels')
            ->select('name', 'fuel_id')
            ->first();
        $map_api = MapOption::select('lat as main_lat', 'lng as main_lng', 'zoom')->first();

        $collection = collect($powerinfo)->merge($fuel);
        $collection = collect($collection)->merge($map_api);
        return response()->json($collection)->setEncodingOptions(JSON_NUMERIC_CHECK);
    }
    /**
     *
     *  Calculated  Power Generated, Ontario Demand, Total Emissions,  CO2e Intensity
     *
     */

    public function Calculation()
    {
        $powerPlants = PowerPlant::latest('updated_at')->select('updated_at')->first();
        $addhour = Carbon::parse($powerPlants->updated_at)->addHour(1)->format('g A');
        $carbon = Carbon::parse($powerPlants->updated_at)->format('D M j, g A');
        $hour = $carbon . " - " . $addhour;

        $powerPlant = PowerPlant::sum('output');  
        $total_output = array(['total_power' => $powerPlant,'hour' => $hour]);
        return response()->json($total_output)->setEncodingOptions(JSON_NUMERIC_CHECK);
    }


    /**
     *
     * show map
     *
     */
    public function Map()
    {
        return view('frontend.map.map');
    }
    public function MapFuel()
    {
        $mapfuel = Fuel::with('maps')->select('id', 'name', 'map_icon', 'logo', 'active')->get();
        return response()->json($mapfuel)->setEncodingOptions(JSON_NUMERIC_CHECK);
    }
    public function MapOption()
    {
        $mapoption = MapOption::select('lng as main_lng', 'lat as main_lat', 'zoom')->first();
        return response()->json($mapoption)->setEncodingOptions(JSON_NUMERIC_CHECK);
    }
    public function mapById($id)
    {
        $map_id = Map::where('id', $id)->select('id', 'title', 'info')->first();
        return response()->json($map_id)->setEncodingOptions(JSON_NUMERIC_CHECK);
    }
    /*------------------------------------------------------
     *
     * coding for generation demand
     *--------------------------------------------------------
     */
    public function Generation()
    {
        return view('frontend.generation.generation');
    }
    /*------------------------------------------------------
     *
     * coding for carbon emissions
     *--------------------------------------------------------
     */
    public function CarbonEmission()
    {
        return view('frontend.carbon.carbon');
    }
    /*------------------------------------------------------
     *
     * coding for carbon emissions
     *--------------------------------------------------------
     */
    public function totalCapacity()
    {
        $fuels = Fuel::get();
        $install_cap_sum = Fuel::sum('install_cap');
        $date = Fuel::latest('install_date')->select('install_date')->first();
        $last_update = Carbon::parse($date->install_date)->format('F Y');
        $capacity = TotalCap::first();
        return view('frontend.capacity.capacity', compact('capacity', 'fuels', 'last_update', 'install_cap_sum'));
    }
    /*------------------------------------------------------
     *
     * coding for How it work it's details slider
     *--------------------------------------------------------
     */
    public function HowItWork()
    {
        $sliders = Slider::orderBy('created_at', 'DESC')->get();
        return view('frontend.howwork.howwork', compact('sliders')); // slider
    }
    



    /*------------------------------------------------------
     *
     * coding for carbon emissions
     *--------------------------------------------------------
     */
    public function HelpAbout()
    {
        return view('frontend.helpabout.helpabout');
    }
    /*------------------------------------------------------
     *
     * coding for chart trends
     *--------------------------------------------------------
     */
    public function Trends()
    {

        return view('frontend.trends.trend');
    }
    public function tempFuel()
    {
        $fuels = Fuel::select('id', 'name', 'logo', 'bg_color as backgroundColor')->get()->map(function ($item) {
            $backup = Backup::where('fuel_id', $item->id)
                ->where('plant_date', Carbon::today())
                ->select([
                    DB::raw("concat(total_output) as total")
                ])
                ->get()
                ->map(function ($item) {
                    return $item['total'];
                });
            $item['data'] = $backup;
            return $item;
        });
        return response()->json($fuels)->setEncodingOptions(JSON_NUMERIC_CHECK);
    }


    public function CapacityChart()
    {
        $fuels = Fuel::select('id', 'total', 'bg_color')->get();
        $data = [];
        $bg_color = [];
        foreach ($fuels as $fuel) {
            $data[] = $fuel->total;
            $bg_color[] = $fuel->bg_color;
        }
        $data = array_merge(['data' => $data, 'backgroundColor' => $bg_color]);

        return response()->json($data)->setEncodingOptions(JSON_NUMERIC_CHECK);
    }
}
