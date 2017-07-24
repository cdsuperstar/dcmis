<?php

namespace App\Http\Controllers;

use App\models\amapplication;
use Illuminate\Http\Request;

class amapplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datas = amapplication::all();
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
        //        return view('home.'.Config::get('app.dctemplate').'.views.am-budget-management.edit');

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
        $rec = new amapplication($request->toArray());
        if ($rec->save()) {
            return response()->json(array_merge([
                    'messages' => trans('data.add', ["data" => $rec->id]),
                    'success' => true,
                ], $rec->toArray()
                )
            );
        }
        return response()->json(['errors' => $rec->id ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\amapplication  $amapplication
     * @return \Illuminate\Http\Response
     */
    public function show(amapplication $amapplication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\amapplication  $amapplication
     * @return \Illuminate\Http\Response
     */
    public function edit(amapplication $amapplication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\amapplication  $amapplication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, amapplication $amapplication)
    {
        //
        if ($amapplication) {

            if ($amapplication->update($request->toArray())) {
                return response()->json(array_merge([
                        'messages' => trans('data.update', ["data" => $amapplication->id]),
                        'success' => true,
                    ], $amapplication->toArray()
                    )
                );
            } else {
                return response()->json(['errors' => $amapplication->errors()->all()]);
            }
        }
        return response()->json(['errors' => [trans('data.notfound')]]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\amapplication  $amapplication
     * @return \Illuminate\Http\Response
     */
    public function destroy(amapplication $amapplication)
    {
        //
        if ($amapplication->delete()) {

            return response()->json(array_merge([
                'messages' => trans('data.destroy', ['rows' => $amapplication->id . " with id ".$amapplication->id]),
                'success' => true,
            ],$amapplication->toArray()));
        } else {
            return response()->json(['errors' => trans('data.destroyfailed', ['data' => $amapplication->id])]);
        }
    }
}
