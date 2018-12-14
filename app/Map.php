<?php

namespace App; 

use Illuminate\Database\Eloquent\Model; 

class Map extends Model {
 public function fuels()
    {
        return $this->belongsTo(Fuel::class, 'fuel_id', 'id');
    }
}
