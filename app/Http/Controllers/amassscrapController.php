<?php

namespace App\Http\Controllers;

use App\models\amassscrap;
use Illuminate\Http\Request;

class amassscrapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datas = amassscrap::all();
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
        $rec = new amassscrap($request->toArray());
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
     * @param  \App\models\amassscrap  $amassscrap
     * @return \Illuminate\Http\Response
     */
    public function show(amassscrap $amassscrap)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\amassscrap  $amassscrap
     * @return \Illuminate\Http\Response
     */
    public function edit(amassscrap $amassscrap)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\amassscrap  $amassscrap
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, amassscrap $amassscrap)
    {
        //
        if ($amassscrap) {

            if ($amassscrap->update($request->toArray())) {
                return response()->json(array_merge([
                        'messages' => trans('data.update', ["data" => $amassscrap->id]),
                        'success' => true,
                    ], $amassscrap->toArray()
                    )
                );
            } else {
                return response()->json(['errors' => $amassscrap->errors()->all()]);
            }
        }
        return response()->json(['errors' => [trans('data.notfound')]]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\amassscrap  $amassscrap
     * @return \Illuminate\Http\Response
     */
    public function destroy(amassscrap $amassscrap)
    {
        //
        if ($amassscrap->delete()) {

            return response()->json(array_merge([
                'messages' => trans('data.destroy', ['rows' => $amassscrap->id . " with id ".$amassscrap->id]),
                'success' => true,
            ],$amassscrap->toArray()));
        } else {
            return response()->json(['errors' => trans('data.destroyfailed', ['data' => $amassscrap->id])]);
        }

    }
}
