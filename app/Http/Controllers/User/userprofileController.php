<?php

namespace App\Http\Controllers\User;

use App\models\userprofile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Config;
use Storage;
use Image;
use Log;


class userprofileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datas = userprofile::all();
        return response()->json($datas);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('home.'.Config::get('app.dctemplate').'.views.user-profile.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rec=userprofile::find($request->user()->id);
        $arrInput=$request->input();

        if(isset($arrInput['signpic'])){
            $imgTmp=Image::make(base64_decode(explode(',',$arrInput['signpic']['result'])[1]))->resize(150, 150);
            $sUni=$request->user()->userprofile->signpic;
            if($sUni==''){
                $sUni='signpic'.uniqid();
                $arrInput['signpic']=$sUni;
            }
            $urlFilename='images/users/'.$request->user()->id."/$sUni.jpg";
        }
        unset($arrInput['signpic']);

        if(!$rec){
            $rec=new  userprofile($arrInput);
            $request->user()->userprofile()->save($rec);
        }else{
            $rec->update($arrInput);
        }

        if ($rec) {
            if(!is_dir('images/users/'.$request->user()->id)){
                mkdir('images/users/'.$request->user()->id);
            }
            if(isset($imgTmp))$imgTmp->save($urlFilename);
            return response()->json(array_merge([
                    'messages' => trans('data.update', ["data" => $rec->id]),
                    'success' => true,
                ], $rec->toArray()
                )
            );
        }
        return response()->json(['errors' => $rec->errors()->all()]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\userprofile  $userprofile
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $rec=userprofile::find($request->user()->id);
        return response()->json($rec);
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\userprofile  $userprofile
     * @return \Illuminate\Http\Response
     */
    public function edit(userprofile $userprofile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\userprofile  $userprofile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, userprofile $userprofile)
    {
        //
        if ($userprofile) {

            if ($userprofile->update($request->toArray())) {
                return response()->json(array_merge([
                        'messages' => trans('data.update', ["data" => $userprofile->id]),
                        'success' => true,
                    ], $userprofile->toArray()
                    )
                );
            } else {
                return response()->json(['errors' => $userprofile->errors()->all()]);
            }
        }
        return response()->json(['errors' => [trans('data.notfound')]]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\userprofile  $userprofile
     * @return \Illuminate\Http\Response
     */
//    public function destroy(userprofile $userprofile)
//    {
//        //
//        if ($userprofile->delete()) {
//
//            return response()->json(array_merge([
//                'messages' => trans('users.deletesuccess', ['rows' => $userprofile->id . " with id ".$userprofile->id]),
//                'success' => true,
//            ],$userprofile->toArray()));
//        } else {
//            return response()->json(['errors' => trans('users.deletesuccess', ['rows' => $userprofile->id])]);
//        }
//
//    }

    public function getMyProfile(Request $request)
    {

        return response()->json($request->user()->userprofile);

    }
}
