<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Stamp;
use App\Models\Rest;
use Illuminate\Http\Request;

class RestController extends Controller
{
    public function startRest(Request $request)
    { 
        $stamp = Stamp::where('user_id',$request->user_id)->latest()->first();
        
        $rest = Rest::create([
            'user_id' => $request->user_id,
            'stamp_id' => $stamp->id,
            'start_rest' => Carbon::now()
        ]);

        return redirect('/')->with('message','休憩開始しました。');
    }

    public function endRest(Request $request)
    {   
        $stamp = Stamp::where('user_id',$request->user_id)->latest()->first();

        $a = Rest::where('stamp_id',$stamp->id)
                     ->latest()
                     ->value('start_rest');

        $start_rest = new Carbon($a);  
        $now = Carbon::now()->format('H:i:s');     
        $resttimeSeconds = $start_rest -> diffInSeconds($now);

        $rest = Rest::where('stamp_id',$stamp->id)->latest()->first()
               ->update([
                'end_rest' => carbon::now(),
                'rest_time' => $resttimeSeconds,
               ]);

        $totalrestSeconds = Rest::where('stamp_id',$stamp->id)->sum('rest_time');  
        
        $hours = floor($totalrestSeconds / 3600);
        $minutes = floor(($totalrestSeconds % 3600) / 60);
        $seconds = $totalrestSeconds % 60;
        $format='%02d:%02d:%02d' ;
        $totalrest = sprintf($format,$hours,$minutes,$seconds);

        Stamp::where('id',$stamp->id)
               ->update([
                'totaltime_rest'=>$totalrest
               ]);

        return redirect('/')->with('message','休憩終了しました。');
    }

}


