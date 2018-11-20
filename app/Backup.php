<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Backup extends Model
{
    protected $fillable = [
        'total_output'
    ];
    public function fuel_backup()
    {
        return $this->belongsTo(Fuel::class, 'fuel_id', 'id');
    }
    public function plants()
    {
        return $this->belongsTo(powerPlant::class, 'plant_id', 'id');
    }
}
