<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodect extends Model
{
    public function prodectD() {
        return $this->hasOne(ProdectDelallis::class,'pro_id');
    }
     public function imgall(){
        return $this->morphMany(allimges::class,'imegeable');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
      public function cartitem(){
        return $this->hasMany(User::class);
    }
      public function reivew(){
        return $this->hasMany(rewiew::class,'pro_id');
    }
}
