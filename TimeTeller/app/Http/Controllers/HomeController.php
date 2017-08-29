<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "HELLO FROM LARAVEL";
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTime()
    {
        $mytime = Carbon::now();
        return $mytime->toDateTimeString();
    }
}
