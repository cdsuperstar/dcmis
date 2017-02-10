<?php

namespace App\Http\Controllers;

use App\models\Permission;
use Illuminate\Http\Request;
use Config;

class permissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datas = Permission::all();
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
        return view('home.'.Config::get('app.dctemplate').'.views.sys-users.edit');

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
        $rec = new Permission($request->toArray());
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
     * @param  \App\models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        //
        if ($permission) {

            if ($permission->update($request->toArray())) {
                return response()->json(array_merge([
                        'messages' => trans('data.update', ["data" => $permission->id]),
                        'success' => true,
                    ], $permission->toArray()
                    )
                );
            } else {
                return response()->json(['errors' => $permission->errors()->all()]);
            }
        }
        return response()->json(['errors' => [trans('data.notfound')]]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        //
        if ($permission->delete()) {

            return response()->json(array_merge([
                'messages' => trans('users.deletesuccess', ['rows' => $permission->id . " with id ".$permission->id]),
                'success' => true,
            ],$permission->toArray()));
        } else {
            return response()->json(['errors' => trans('users.deletesuccess', ['rows' => $permission->id])]);
        }

    }
}
