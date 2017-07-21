<?php

namespace App\Http\Controllers;

use App\models\ambudget;
use Illuminate\Http\Request;
use Log;

class ambudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datas = ambudget::all();
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
        return view('home.'.Config::get('app.dctemplate').'.views.am-budget-management.edit');

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
        Log::info($request->toArray());
        $rec = new ambudget($request->toArray());
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
     * @param  \App\models\ambudget  $ambudget
     * @return \Illuminate\Http\Response
     */
    public function show(ambudget $ambudget)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\ambudget  $ambudget
     * @return \Illuminate\Http\Response
     */
    public function edit(ambudget $ambudget)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\ambudget  $ambudget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ambudget $ambudget)
    {
        //
//        Log::info($request->toArray());
        if ($ambudget) {

            if ($ambudget->update($request->toArray())) {
                return response()->json(array_merge([
                        'messages' => trans('data.update', ["data" => $ambudget->id]),
                        'success' => true,
                    ], $ambudget->toArray()
                    )
                );
            } else {
                return response()->json(['errors' => $ambudget->errors()->all()]);
            }
        }
        return response()->json(['errors' => [trans('data.notfound')]]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\ambudget  $ambudget
     * @return \Illuminate\Http\Response
     */
    public function destroy(ambudget $ambudget)
    {
        //
        if ($ambudget->delete()) {

            return response()->json(array_merge([
                'messages' => trans('data.destroy', ['rows' => $ambudget->id . " with id ".$ambudget->id]),
                'success' => true,
            ],$ambudget->toArray()));
        } else {
            return response()->json(['errors' => trans('data.destroyfailed', ['data' => $ambudget->id])]);
        }

    }
}
