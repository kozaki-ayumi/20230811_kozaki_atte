<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'stamp_id',
        'start_rest',
        'end_rest',
        'rest_time',
    ];
    
    public function stamp(){ 
        return $this->belongsTo('App\Models\Stamp');
    }    
    
}
