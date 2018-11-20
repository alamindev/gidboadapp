<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PowerPlant extends Model
{
    public function fuels()
    {
        return $this->belongsTo(Fuel::class, 'fuel_id', 'id');
    }
    public function power_info()
    {
        return $this->hasMany(PowerInfo::class);
    }
}
