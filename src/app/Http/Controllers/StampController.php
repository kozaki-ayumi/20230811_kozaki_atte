<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Stamp;
use App\Models\Rest;

class StampController extends Controller
{

    public function startWork(Request $request)
    {
        $stamp = Stamp::create([
            'user_id' => $request->user_id,
            'date' => Carbon::now()->format('Y-m-d'),
            'start_work' => Carbon::now()
        ]);

        $request->session()->regenerateToken();

        return redirect('/')->with('message','勤務開始しました。');
    }

    public function endWork(Request $request)
    {
        $stamp = Stamp::where('user_id',$request->user_id)->latest()->first();

        $rest = Rest::where('stamp_id',$stamp->id)->latest()->first();
        if(empty($rest->end_rest))
        {
            $start_rest =  new Carbon($rest->start_rest);  
            $now = Carbon::now()->format('H:i:s');
            $resttimeSeconds = $start_rest -> diffInSeconds($now);

            Rest::where('stamp_id',$stamp->id)->latest()->first()
               ->update([
                'end_rest'=> Carbon::now()->format('H:i:s'),
                'rest_time' => $resttimeSeconds,
               ]);

            $totalrestSeconds = Rest::where('stamp_id',$stamp->id)
                              ->sum('rest_time');

            $hours = floor($totalrestSeconds / 3600);
            $minutes = floor(($totalrestSeconds % 3600) / 60);
            $seconds = $totalrestSeconds % 60;
            $format='%02d:%02d:%02d' ;
            $totalrest = sprintf($format,$hours,$minutes,$seconds); 

            Stamp::where('id',$stamp->id)
                 ->update([
                'totaltime_rest'=>$totalrest
               ]);
        }

        $a = Stamp::where('id',$stamp->id)->value('start_work');
        $start_work = new Carbon($a);
        $now = Carbon::now()->format('H:i:s');
        $noRest_totalworkSeconds = $start_work -> diffInSeconds($now);

        $totalrestSeconds = Rest::where('stamp_id',$stamp->id)->sum('rest_time');

        $totalworkSeconds =  $noRest_totalworkSeconds - $totalrestSeconds;

        $hours = floor($totalworkSeconds / 3600);
        $minutes = floor(($totalworkSeconds % 3600) / 60);
        $seconds = $totalworkSeconds % 60;
        $format='%02d:%02d:%02d' ;
        $totalwork = sprintf($format,$hours,$minutes,$seconds);

        Stamp::where('id',$stamp->id)
             ->update([
                 'end_work'=> carbon::now(),
                 'totaltime_work' => $totalwork,
             ]);

        if(empty($totalrestSeconds))
         { 
            Stamp::where('id',$stamp->id)
               ->update([
                'totaltime_rest'=>'00:00:00'
               ]);
         }
         
        $request->session()->regenerateToken();  

        return redirect('/')->with('message','勤務終了しました。');
    }
    
}
