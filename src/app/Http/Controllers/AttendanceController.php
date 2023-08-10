<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Stamp;
use Carbon\Carbon;



class AttendanceController extends Controller
{
     public function index ()
    {
     $pagedate = Carbon::now()->format('Y-m-d');   
     $stamps = Stamp::where('date',Carbon::now()->format('Y-m-d'))->paginate(5);

        return view('attendance',compact('pagedate','stamps'));
    }

    public function before (Request $request)
    {
       $pagedateBefore = new Carbon($request->pagedate);
       $pagedate = $pagedateBefore->subDay()->format('Y-m-d');

       $stamps = Stamp::where('date',$pagedate)->paginate(5);

       return view('attendance',compact('pagedate','stamps'));
    }

    public function after (Request $request)
    {
       $pagedateBefore = new Carbon($request->pagedate);
       $pagedate = $pagedateBefore->addDay()->format('Y-m-d');

       $stamps = Stamp::where('date',$pagedate)->paginate(5);

       return view('attendance',compact('pagedate','stamps'));
      }


    public function userAttendance (Request $request)
    {
     $stamps = Stamp::where('user_id',$request->user_id)->latest()
     ->paginate(5);

        return view('user_attendance',compact('stamps'));
    }

    }