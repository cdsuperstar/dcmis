<?php

namespace App\Http\Controllers;

use App\models\Role;
use App\models\dcMdGrp;
use Illuminate\Http\Request;
use Config;
use Log;


class roleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datas = Role::all();
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
        return view('home.' . Config::get('app.dctemplate') . '.views.sys-role.edit');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rec = new Role($request->toArray());
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
     * @param  \App\models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
//        return view('assets.edition')->with([
//            'fields' => Role::$angularrules,
//            'title' => '用户',
//        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {

        if ($role) {

            if ($role->update($request->toArray())) {
                return response()->json(array_merge([
                        'messages' => trans('data.update', ["data" => $role->id]),
                        'success' => true,
                    ], $role->toArray()
                    )
                );
            } else {
                return response()->json(['errors' => $role->errors()->all()]);
            }
        }
        return response()->json(['errors' => [trans('data.notfound')]]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if ($role->delete()) {

            return response()->json(array_merge([
                'messages' => trans('users.deletesuccess', ['rows' => $role->id . " with id " . $role->id]),
                'success' => true,
            ], $role->toArray()));
        } else {
            return response()->json(['errors' => trans('users.deletesuccess', ['rows' => $role->id])]);
        }
        //
    }

    public function postSetModels(Role $role, $dcmodels = '')
    {
        $arrMod = json_decode($dcmodels);
        $role->models()->detach();
        foreach ($arrMod as $key => $val) {
            $role->models()->attach(dcMdGrp::find($val)->dcmodel_id);
        }

        return response()->json(array_merge([
            'messages' => trans('data.add', ['data' => "X" . count($arrMod)]),
            'success' => true,
        ], []));

    }

    public function getRoleModels(Role $role)
    {
        $resMdGrps=dcMdGrp::wherein('dcmodel_id',$role->models->pluck('id'))->get();
        return response()->json($resMdGrps);
    }

    /**
     * get perms of the role
     * @param Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRolePerms(Role $role)
    {
        $resPerms=$role->perms->sortBy('name')->values();

        return response()->json($resPerms);
    }
}
