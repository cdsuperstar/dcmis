<?php

namespace App\Http\Controllers;

use App\models\dcmodel;

use App\User;
use Illuminate\Http\Request;
use Log;
use Carbon\Carbon;
use App\models\usermsg;
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

    public function testit(Request $request)
    {
//        Log::info($data);
        event(new \App\Events\normal("测试，马上开会了！" . time()));
        $rec=User::find(6);
        $msg=(object)null;
        $msg->photo="../assets/layouts/layout4/img/avatar3.jpg";
        $msg->sendername=$rec->name;
        $msg->body="just test shit!";
//        $msg->created_at=Carbon::now()->diffForHumans(Carbon::now()->addSeconds(10));
        $msg->created_at=$rec->created_at->toTimeString();
        event(new \App\Events\EventUsermsg(1,$msg));
//        event(new \App\Events\usercmd("\$scope.dcUser.name='fucking haead';"));

        echo "fucking head";
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

    public function getLockScreen(Request $request,String $layout)
    {
        /* @var $user User */
        $user=$request->user();
        $sView = 'home.' . $layout . ".lock";
        if($user->userprofile->signpic==""){
            $signpic="defaultuser";
        }else{
            $signpic=$user->id."/".$user->userprofile->signpic;

        }
        return view($sView,['name' => $user->name, 'email' => $user->email, 'signpic' => $signpic]);
    }

    public function tpl(String $layout, String $tpl)
    {
        $sView = 'home.' . $layout . ".tpl." . $tpl;
        return view($sView);
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
}
