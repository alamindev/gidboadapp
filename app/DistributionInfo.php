<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DistributionInfo extends Model
{
    public function distributions()
    {
        return $this->belongsTo(Distribution::class, 'distribution_id', 'id');
    }
}
