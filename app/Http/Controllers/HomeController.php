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
use App\HowTo;
use Carbon\Carbon;
use App\PowerPlant;
use App\Distribution;
use App\DistributionInfo;
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
            $addhour = Carbon::now()->addHour(1)->format('g A');
            $carbon = Carbon::now()->format('D M j, g A');
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
        $collection = collect($powerinfo)->merge($fuel); 
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
        $aboutandhow = HowTo::first();
        return view('frontend.helpabout.helpabout',compact('aboutandhow'));
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
        $subday = Carbon::now()->subDays(1)->format('Y-m-d');
        $subday1 = Carbon::now()->subDays(2)->format('Y-m-d');
        $subday2 = Carbon::now()->subDays(3)->format('Y-m-d');
        $subday3 = Carbon::now()->subDays(4)->format('Y-m-d');
        $subday4 = Carbon::now()->subDays(5)->format('Y-m-d');
        $today = Carbon::now()->format('Y-m-d');
        $backupdata = Backup::select('plant_date')->get();
        $Hour  = Backup::latest()->first();  
        $latesthour =  $Hour->time; //find out time only for where clause in down 
        global $data; 
        
        //foreach loop for subdata
        foreach($backupdata as $backup){ 
            $data = $backup->plant_date; 
        }//end backup foreach loop   
        $length = 24;  
        $datas = [];
        for($i=0; $i < $length; $i++){  
            $filter = sprintf("%02d", $i); 
            if($filter == $i){ 
                if($data == $today){  
                        $times = Backup::where('plant_date',$today)  
                        ->where('time',$filter)
                        ->select('time')
                        ->first();  
                        if($times != ''){
                            $datas[] = Backup::where('plant_date',$today)  
                            ->where('time',$filter)
                            ->select('id','fuel_id','total_output')
                            ->get();  
                        }else{ 
                            $datas[] = Backup::where('plant_date',$today)  
                            ->where('time',$latesthour)
                            ->select('id','fuel_id','total_output') 
                            ->get(); 
                        }     
                 }elseif($data == $subday){   
                    $datas[] = Backup::where('plant_date',$subday)  
                        ->where('time',$latesthour)
                        ->select('id','fuel_id','total_output') 
                        ->get();
                 }elseif($data == $subday1){   
                    $datas[] = Backup::where('plant_date',$subday1)  
                        ->where('time',$latesthour)
                        ->select('id','fuel_id','total_output') 
                        ->get();
                 }
                 elseif($data == $subday2){   
                    $datas[] = Backup::where('plant_date',$subday2)  
                        ->where('time',$latesthour)
                        ->select('id','fuel_id','total_output') 
                        ->get();
                 }elseif($data == $subday3){   
                    $datas[] = Backup::where('plant_date',$subday3)  
                        ->where('time',$latesthour)
                        ->select('id','fuel_id','total_output') 
                        ->get();
                 }elseif($data == $subday4){   
                    $datas[] = Backup::where('plant_date',$subday4)  
                        ->where('time',$latesthour)
                        ->select('id','fuel_id','total_output') 
                        ->get();
                 }
            }   
            
             $now =  Carbon::now()->format('H');
             if($now == $filter){
                  break;
             }   
        }
         $collections = collect($datas)->flatten(1)->groupBy('fuel_id')->toArray(); 
           
        foreach($collections as $collection){ 
             foreach($collection as $main){  
                if($main['fuel_id'] == 1){
                    $firstItem[] = $main;
                }
                if($main['fuel_id'] == 2){
                    $secontItem[] = $main;
                }
                // if($main['fuel_id'] == 3){
                //     $thirthItem[] = $main;
                // }
                // if($main['fuel_id'] == 4){
                //     $fourthItem[] = $main;
                // }
                // if($main['fuel_id'] == 5){
                //     $fifthItem[] = $main;
                // }

             }
        }    
        $firstData = collect($firstItem)->map(function($item){
            return $item['total_output'];
        });
       $secondData = collect($secontItem)->map(function($item){
            return $item['total_output'];
        }); 
    //    $thirthData = collect($thirthItem)->map(function($item){
    //         return $item['total_output'];
    //     }); 
    //    $fourthData = collect($fourthItem)->map(function($item){
    //         return $item['total_output'];
    //     }); 
    //    $fifthData = collect($fifthItem)->map(function($item){
    //         return $item['total_output'];
    //     });  
    if($data == $today){
        $fuels = Fuel::with('backup')->select('id', 'name', 'logo', 'bg_color as backgroundColor')->get();
    }elseif($data == $subday){
        $fuels = Fuel::with('backup')->select('id', 'name', 'logo', 'bg_color as backgroundColor')->get();
    }elseif($data == $subday1){
        $fuels = Fuel::with('backup')->select('id', 'name', 'logo', 'bg_color as backgroundColor')->get();
    }elseif($data == $subday2){
        $fuels = Fuel::with('backup')->select('id', 'name', 'logo', 'bg_color as backgroundColor')->get();
    }elseif($data == $subday3){
        $fuels = Fuel::with('backup')->select('id', 'name', 'logo', 'bg_color as backgroundColor')->get();
    }elseif($data == $subday4){
        $fuels = Fuel::with('backup')->select('id', 'name', 'logo', 'bg_color as backgroundColor')->get();
    }
    $fuels->map(function($itm) use ($firstData,$secondData) /*,$thirthData,$fourthData,$fifthData */ {   
        if($itm->id == 1){
            $data = $firstData;
            $itm['data'] = $data;
            return $itm;  
        }
        if($itm->id == 2){
            $data = $secondData;
            $itm['data'] = $data;
            return $itm;  
        } 
       //  if($itm->id == 3){
       //      $data = $thirthData;
       //      $itm['data'] = $data;
       //      return $itm;  
       //  } 
       //  if($itm->id == 4){
       //      $data = $fourthData;
       //      $itm['data'] = $data;
       //      return $itm;  
       //  } 
       //  if($itm->id == 5){
       //      $data = $fifthData;
       //      $itm['data'] = $data;
       //      return $itm;  
       //  } 
     });
    return response()->json($fuels)->setEncodingOptions(JSON_NUMERIC_CHECK); 
    }

     /**
     * 
     * start coding for distribution info method
     * 
     */
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
    /**
     * 
     * start coding for distribution info method
     * 
     */
    public function DistributionInfo($id){
        $distributioninfo = DistributionInfo::with('distributions')->where('distribution_id', $id)->first();
          
        return response()->json($distributioninfo)->setEncodingOptions(JSON_NUMERIC_CHECK);
    }

    
}