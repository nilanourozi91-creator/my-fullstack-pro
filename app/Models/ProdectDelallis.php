<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdectDelallis extends Model
{
   protected $fillable = [
    
  
    'brand',
    'addcatagorys',
    'description',
    'pro_id',
   ];

   public function prodect(){
     return $this->belongsTo(Prodect::class ,'pro_id');
}

}
