<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    public function distribution_info()
    {
        return $this->hasMany(DistributionInfo::class);
    }
}
