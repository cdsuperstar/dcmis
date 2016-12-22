<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(String $layout, String $pagelv1 = null, String $pagelv2 = null)
    {
        $sView = 'home.' . $layout;
        $sView .= $pagelv1 ? '.' . $pagelv1 : null;
        $sView .= $pagelv2 ? '.' . $pagelv2 : null;
        return view($sView);
    }

}
