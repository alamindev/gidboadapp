<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PowerInfo extends Model
{
    public function power_plant()
    {
        return $this->belongsTo(PowerPlant::class, 'power_id', 'id');
    }
}
