<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cartshopitems extends Model
{
     public function prodect(){
        return $this->belongsT(Prodect::class,'pro_id');
    }
  
}
