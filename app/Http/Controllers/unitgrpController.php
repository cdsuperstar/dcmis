<?php

namespace App\Http\Controllers;

use App\models\unitgrp;
use Illuminate\Http\Request;
use Config;
use DB;

class unitgrpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $resData = unitgrp::all();
        return response()->json($resData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('home.'.Config::get('app.dctemplate').'.views.user-department.edit');
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
        $rec = new unitgrp($request->toArray());
        if ($rec) {
            if ($rec->save($request->toArray())) {
                $pNode = unitgrp::where('parent_id', null)->orderby('id','asc')->first();
                if($pNode)
//                    $pNode->children()->create(['dcmodel_id' => $rec->id]);
                    $rec->makeChildOf($pNode);

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
     * @param  \App\models\unitgrp  $unitgrp
     * @return \Illuminate\Http\Response
     */
    public function show(unitgrp $unitgrp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\unitgrp  $unitgrp
     * @return \Illuminate\Http\Response
     */
    public function edit(unitgrp $unitgrp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\unitgrp  $unitgrp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, unitgrp $unitgrp)
    {
        //
        if ($unitgrp) {

            if ($unitgrp->update($request->toArray())) {
                return response()->json(array_merge([
                        'messages' => trans('data.update', ["data" => $unitgrp->id]),
                        'success' => true,
                    ], $unitgrp->toArray()
                    )
                );
            } else {
                return response()->json(['errors' => $unitgrp->errors()->all()]);
            }
        }
        return response()->json(['errors' => [trans('data.notfound')]]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\unitgrp  $unitgrp
     * @return \Illuminate\Http\Response
     */
    public function destroy(unitgrp $unitgrp)
    {
        //
        if ($unitgrp->delete()) {

            return response()->json(array_merge([
                'messages' => trans('users.deletesuccess', ['rows' => $unitgrp->id . " with id ".$unitgrp->id]),
                'success' => true,
            ],$unitgrp->toArray()));
        } else {
            return response()->json(['errors' => trans('users.deletesuccess', ['rows' => $unitgrp->id])]);
        }

    }

    public function getTree()
    {
        unitgrp::rebuild(true);
        $tree = unitgrp::where('id','<>',0)->orderby('lft','asc')->select('id as id', 'parent_id as parent','name as text','brief as data',DB::raw('\'icon-users\' as icon'))->get();

        foreach ($tree as $node) {
            if ($node->parent == null) {
                $node->parent = '#';
            }

        }
        return response()->json($tree);
    }

    public function postMovenode(Request $req)
    {
        $pNode = unitgrp::where('id', '=', $req->parent)->first();
        $cNode = unitgrp::where('id', '=', $req->node['id'])->first();
        $cNode->makeFirstChildOf($pNode);
        for ($i = 0; $i < $req->position; $i++) {
            if ($cNode->getRightSibling() != null)
                $cNode->moveRight();
        }
        return response()->json([
            'messages' => trans('data.movesuccess', ['cNode' => $cNode->dcmodel->title, 'pNode' => $pNode->dcmodel->title]),
            'success' => true,
            'data' => '',
        ]);
    }

}
