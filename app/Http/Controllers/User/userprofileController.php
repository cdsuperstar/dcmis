<?php

namespace App\Http\Controllers\User;

use App\models\userprofile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Config;

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
        $rec = new userprofile($request->toArray());
        if ($rec) {
            if ($rec->save($request->toArray())) {
                return response()->json(array_merge([
                        'messages' => trans('data.add', ["data" => $rec->id]),
                        'success' => true,
                    ], $rec->toArray()
                    )
                );
            }
        }
        return response()->json(['errors' => $rec->errors()->all()]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\userprofile  $userprofile
     * @return \Illuminate\Http\Response
     */
    public function show(userprofile $userprofile)
    {
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
    public function destroy(userprofile $userprofile)
    {
        //
        if ($userprofile->delete()) {

            return response()->json(array_merge([
                'messages' => trans('users.deletesuccess', ['rows' => $userprofile->id . " with id ".$userprofile->id]),
                'success' => true,
            ],$userprofile->toArray()));
        } else {
            return response()->json(['errors' => trans('users.deletesuccess', ['rows' => $userprofile->id])]);
        }

    }

    public function getMyProfile(Request $request)
    {
        return response()->json($request->user()->userprofile);

    }
}
