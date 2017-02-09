<?php

namespace App\Http\Controllers\User;

use App\User;
use Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class userController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = User::all();
        return response()->json($datas);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.'.Config::get('app.dctemplate').'.views.sys-users.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        if ($user) {
            foreach ($request->input() as $key => $val) {
                $user->$key = $val;
            }

            if ($user->save()) {
                return response()->json(array_merge([
                        'messages' => trans('users.savesuccess', ["data" => $user->name]),
                        'success' => true,
                    ], $user->toArray()
                    )
                );
            }
        }
        return response()->json(['errors' => $user->errors()->all()]);

        //

        //
    }

    /**
     * Display the specified resource.
     *
     * @param  String $id
     * @return \Illuminate\Http\Response
     */
    public function show(String $id)
    {
        $datas = User::where('id', '=', $id)->get();
        return response()->json($datas);

        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $appUser
     * @return \Illuminate\Http\Response
     */
    public function edit(User $appUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  String $appUser
     * @return \Illuminate\Http\Response
     */
    public function update(String $id, Request $request)
    {
        if (!$id) return false;

        $user = User::find($id);
        if ($user) {
            foreach ($request->input() as $key => $val) {
                $user->$key = $val;
            }

            if ($user->updateUniques()) {
                return response()->json(array_merge([
                        'messages' => trans('users.updatesuccess', ["data" => $user->name]),
                        'success' => true,
                    ], $user->toArray()
                    )
                );
            } else {
                return response()->json(['errors' => $user->errors()->all()]);
            }
        }
        return response()->json(['errors' => [trans('users.nofound')]]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  String $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(String $id)
    {
        $aTodel = array();
        $aTmp = json_decode($id);
        if (is_array($aTmp)) {
            $aTodel = $aTmp;
        } else {
            $aTodel[] = $id;
        }

        $deletedRows = User::destroy($aTodel);
        if ($deletedRows) {
            return response()->json([
                'messages' => trans('users.deletesuccess', ['rows' => $deletedRows . " with id $id"]),
                'success' => true,
                'data' => $deletedRows,
            ]);
        } else {
            return response()->json(['errors' => trans('users.deletesuccess', ['rows' => $deletedRows])]);
        }
    }

    public function getEdition()
    {

        return view('assets.edition')->with([
            'fields' => User::$angularrules,
            'title' => '用户编辑器',
        ]);
    }
}

