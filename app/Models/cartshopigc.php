<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cartshopigc extends Model
{
   public function user() {
      return $this->belongsTo(User::class);
   }
      public function cartitem() {
      return $this->belongsTo(User::class);
   }
}
