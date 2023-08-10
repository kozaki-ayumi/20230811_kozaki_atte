<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stamp extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'start_work',
        'end_work',
        'totaltime_rest',
        'totaltime_work',
    ];

   public function user(){ 
        return $this->belongsTo('App\Models\User');
   }  
   
   public function rest(){
         return $this->hasMany('App\Models\Rest');
   }
}
