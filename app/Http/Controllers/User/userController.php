<?php

namespace App\Http\Controllers\User;

use App\models\Role;
use App\User;
use Config;
use Illuminate\Http\Request;
use Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Log;

class userController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = User::with(['userprofile.unitgrp', 'roles'])->get();
        return response()->json($datas);
        //
    }

    public function getUsersByUnitgrpOrEmptyunitgrp(Request $request)
    {
        $arrUnits = array();
        $request->user()->unitgrps()->each(function ($e) use (&$arrUnits) {
            $arrUnits = array_unique(array_merge($arrUnits, $e->getDescendantsAndSelf()->pluck('id')->all()));
        });
        $recUsers = User::wherein('id', function ($query) use ($arrUnits) {
            $query->select('user_id')->from('unitgrp_user')->wherein('unitgrp_id', $arrUnits);
        })->union(User::wherenotin('id', function ($query) {
            $query->select('user_id')->from('unitgrp_user');
        }))->get();
        return response()->json($recUsers);

    }

    public function getLoginedUser(Request $request)
    {
        isset($request->user()->userprofile) ?
            $aMerge = array_merge($request->user()->toArray(), $request->user()->userprofile->toArray()) : $aMerge = $request->user()->toArray();
        return response()->json($aMerge);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.' . Config::get('app.dctemplate') . '.views.sys-users.edit');
    }

    public function setUserRole(User $user, Role $role)
    {
        $user->detachRoles();
        $user->attachRole($role);
        return response()->json(array_merge([
                'messages' => trans('users.updatesuccess', ["data" => $user->name]),
                'success' => true,
            ], $user->roles()->get()->toArray()
            )
        );
    }

    public function setMyPassword(Request $request)
    {
        if (Input::get("oldpwd") == ""||Input::get("newpwd")=="") {
            return response()->json(['errors' => "密码不得为空！"]);
        }
        $rec=User::find($request->user()->id);
        if(!Hash::check(Input::get("oldpwd"),$rec->password)){
            return response()->json(['errors' => "旧密码不正确！"]);
        }
        $rec->password=Input::get("newpwd");
        $rec->password_confirmation=Input::get("newpwd");
        if($rec->save()){
            return response()->json(array_merge([
                    'messages' => trans('users.updatesuccess', ["data" => $rec->name]),
                    'success' => true,
                ], []
                )
            );
        }else{
            return response()->json(['errors' => $rec->errors()->all()]);
        }
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
            $aTmp = array();
            foreach ($request->input() as $key => $val) {
                $aTmp[$key] = $val;
            }
            $user->fill($aTmp);
            $user->password_confirmation = $user->password;
            if ($user->save()) {
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
    public function destroy(User $user)
    {
        $user->delete();

        if (!User::find($user->id)) {
            return response()->json(
                array_merge(
                    [
                        'messages' => trans('users.deletesuccess', ['rows' => 1 . " with id " . $user->id]),
                        'success' => true,
                    ],
                    $user->toArray()
                )
            );
        } else {
            return response()->json(['errors' => trans('users.deletesuccess', ['rows' => $user->id])]);
        }
    }

    public function getEdition()
    {

        return view('assets.edition')->with([
            'fields' => User::$angularrules,
            'title' => '用户编辑器',
        ]);
    }

    public function getOnlineUsers()
    {
        $recDatas = User::select('users.*')->join('sessions', 'users.id', '=', 'sessions.user_id')->get();
        return response()->json($recDatas);
    }

    /**
     * get perms of login user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserPerms(Request $request)
    {
        $resPerms = $request->user()->roles->pluck('perms')[0];
        return response()->json($resPerms);
    }

}

