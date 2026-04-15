<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rewiew extends Model
{
     public function prodect(){
        return $this->belongsTo(Prodect::class);
    }
     public function user(){
        return $this->belongsTo(User::class);
    }
}
