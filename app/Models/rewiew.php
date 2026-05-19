<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rewiew extends Model
{
    protected $fillable = [
        'user_id',
        'prodect_id',
        'rating'
    ];
     public function prodect(){
        return $this->belongsTo(Prodect::class,'prodect_id');
    }
     public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
