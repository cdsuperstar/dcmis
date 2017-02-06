<?php

namespace App\Http\Controllers;

use App\models\dcMdGrp;
use App\models\dcmodel;

use App\User;
use Illuminate\Http\Request;

//use App\Http\Requests;
use Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function testit()
    {
       \Log::info( event(new \App\Events\normal("测试，马上开会了！".time())));

        echo "shit";
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
        return view($sView,['user'=>\Auth::user()]);
    }

    public function views(String $layout, String $views, Request $req)
    {
        $aTitle = [];
        dcmodel::where('name', $views)->first()->dcMdGrp->getAncestorsAndSelf()->each(function ($e) use (&$aTitle) {
            $aTitle[] = $e->dcmodel->title;
        });
        array_shift($aTitle);
        return view("home." . $layout . ".templateurl", ['sModel' => $views, 'layout' => $layout, 'aTitle' => $aTitle, 'user' => $req->user()]);
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
