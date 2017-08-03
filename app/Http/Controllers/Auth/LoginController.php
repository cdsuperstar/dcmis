<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Laravel\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = 'index';

    public function showLoginForm(String $layout)
    {
        $sView = 'home.' . $layout . ".login";
        return view($sView,["loginmsg"=>$this->sendFailedLoginResponse()]);
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
//        \Log::info($request);
        $this->redirectTo=$this->getRedirectUrl().'/../index';
        $this->middleware('guest', ['except' => 'logout']);
    }

//    public function redirectToProvider()
//    {
//        return Socialite::driver('qq')->redirect();
//    }
//
//    public function handleProviderCallback()
//    {
//        $user = Socialite::driver('qq')->user();
//
//        // $user->token;
//    }
}
