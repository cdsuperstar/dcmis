<?php

namespace App\Http\Controllers;

use App\models\dcMdGrp;
use App\models\dcmodel;

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
    public function index(String $layout)
    {
        $sView = 'home.' . $layout . ".index";
        return view($sView);
    }

    public function tpl(String $layout, String $tpl)
    {
        $sView = 'home.' . $layout . ".tpl." . $tpl;
        return view($sView);
    }

    public function jsMain(String $layout)
    {
        $mdTreeJson = dcMdGrp::with(['dcmodel' => function ($q) {
            $q->addSelect(array('id', 'name', 'title', 'ismenu', 'icon', 'url', 'templateurl', 'files'));
        }])->get()->tohierarchy()->toJson();
        $dcModels = dcmodel::where('url', '<>', '')->get();
        $sView = 'home.' . $layout . ".js.main";
        return view($sView, ['mdTreeJson' => $mdTreeJson, 'dcModels' => $dcModels]);
    }
}
