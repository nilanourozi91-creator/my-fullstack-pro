<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class allimges extends Model
{
    public function imegeable() {
        return $this->morphTo();
    }
}
