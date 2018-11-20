<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Fuel extends Model
{
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
        $date = Carbon::today()->format('Y-m-d');
        return $this->hasMany(Backup::class)->whereDate('plant_date', $date);
    }

}
