<?php

namespace App\Http\Controllers;

use App\models\amassetsreg;
use Illuminate\Http\Request;

class amassetsregController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datas = amassetsreg::all();
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
        $rec = new amassetsreg($request->toArray());
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
     * @param  \App\models\amassetsreg  $amassetsreg
     * @return \Illuminate\Http\Response
     */
    public function show(amassetsreg $amassetsreg)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\amassetsreg  $amassetsreg
     * @return \Illuminate\Http\Response
     */
    public function edit(amassetsreg $amassetsreg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\amassetsreg  $amassetsreg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, amassetsreg $amassetsreg)
    {
        //
        if ($amassetsreg) {

            if ($amassetsreg->update($request->toArray())) {
                return response()->json(array_merge([
                        'messages' => trans('data.update', ["data" => $amassetsreg->id]),
                        'success' => true,
                    ], $amassetsreg->toArray()
                    )
                );
            } else {
                return response()->json(['errors' => $amassetsreg->errors()->all()]);
            }
        }
        return response()->json(['errors' => [trans('data.notfound')]]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\amassetsreg  $amassetsreg
     * @return \Illuminate\Http\Response
     */
    public function destroy(amassetsreg $amassetsreg)
    {
        //
        if ($amassetsreg->delete()) {

            return response()->json(array_merge([
                'messages' => trans('data.destroy', ['rows' => $amassetsreg->id . " with id ".$amassetsreg->id]),
                'success' => true,
            ],$amassetsreg->toArray()));
        } else {
            return response()->json(['errors' => trans('data.destroyfailed', ['data' => $amassetsreg->id])]);
        }

    }
}
