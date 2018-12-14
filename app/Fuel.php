<?php
namespace App; 
use Illuminate\Database\Eloquent\Model; 
use Carbon\Carbon; 

class Fuel extends Model {
	    public function power_plants()
    {
        return $this->hasMany(PowerPlant::class)->selectRaw('power_plants.fuel_id,SUM(power_plants.output) as total, SUM(power_plants.output) * 100  as percent')->groupBy('power_plants.fuel_id');
    }
    public function powers()
    {
        return $this->hasMany(PowerPlant::class);
    }
    public function maps()
    {
        return $this->hasMany(Map::class);
    }

    public function backup()
    {

        $subday = Carbon::now()->subDays(1)->format('Y-m-d');
        $subday1 = Carbon::now()->subDays(2)->format('Y-m-d');
        $subday2 = Carbon::now()->subDays(3)->format('Y-m-d');
        $subday3 = Carbon::now()->subDays(4)->format('Y-m-d');
        $subday4 = Carbon::now()->subDays(5)->format('Y-m-d');
        $today = Carbon::now()->format('Y-m-d');
        $backupdata = Backup::select('plant_date')->get();
        global $data; 
        
        //foreach loop for subdata
        foreach($backupdata as $backup){ 
            $data = $backup->plant_date; 
        }//end backup foreach loop 


        if($data == $today){
            $date = Carbon::today()->format('Y-m-d');
            return $this->hasMany(Backup::class)->whereDate('plant_date', $date);
        }elseif($data == $subday){
            $subday = Carbon::now()->subDays(1)->format('Y-m-d');
            return $this->hasMany(Backup::class)->whereDate('plant_date', $subday);
        }elseif($data == $subday1){
            $subday1 = Carbon::now()->subDays(1)->format('Y-m-d');
            return $this->hasMany(Backup::class)->whereDate('plant_date', $subday1);
        }elseif($data == $subday2){
            $subday2 = Carbon::now()->subDays(1)->format('Y-m-d');
            return $this->hasMany(Backup::class)->whereDate('plant_date', $subday2);
        }elseif($data == $subday3){
            $subday3 = Carbon::now()->subDays(1)->format('Y-m-d');
            return $this->hasMany(Backup::class)->whereDate('plant_date', $subday3);
        }elseif($data == $subday4){
            $subday4 = Carbon::now()->subDays(1)->format('Y-m-d');
            return $this->hasMany(Backup::class)->whereDate('plant_date', $subday4);
        }  

    }

//   public function backup_subday()
//     {
//           $subday = Carbon::now()->subDays(1)->format('Y-m-d');
//         return $this->hasMany(Backup::class)->whereDate('plant_date', $subday);
//     }  

// public function backup_subday1()
//     {
//           $subday = Carbon::now()->subDays(2)->format('Y-m-d');
//         return $this->hasMany(Backup::class)->whereDate('plant_date', $subday);
//     }  
// public function backup_subday2()
//     {
//           $subday = Carbon::now()->subDays(3)->format('Y-m-d');
//         return $this->hasMany(Backup::class)->whereDate('plant_date', $subday);
//     }  
// public function backup_subday3()
//     {
//           $subday = Carbon::now()->subDays(4)->format('Y-m-d');
//         return $this->hasMany(Backup::class)->whereDate('plant_date', $subday);
//     }  
// public function backup_subday4()
//     {
//           $subday = Carbon::now()->subDays(5)->format('Y-m-d');
//         return $this->hasMany(Backup::class)->whereDate('plant_date', $subday);
//     }

}