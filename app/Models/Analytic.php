<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Analytic extends Model
{
    public function link ()
    {
        return $this->belongsTo(Link::class);
    }
}
