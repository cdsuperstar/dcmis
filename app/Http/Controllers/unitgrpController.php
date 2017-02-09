<?php

namespace App\Http\Controllers;

use App\models\unitgrp;
use Illuminate\Http\Request;

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
}
