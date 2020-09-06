<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{

    public function analytics ()
    {
        return $this->hasMany(Analytic::class);
    }
}
