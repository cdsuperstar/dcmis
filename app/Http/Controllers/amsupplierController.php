<?php

namespace App\Http\Controllers;

use App\models\amsupplier;
use Illuminate\Http\Request;

class amsupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datas = amsupplier::all();
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
        $rec = new amsupplier($request->toArray());
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
     * @param  \App\models\amsupplier  $amsupplier
     * @return \Illuminate\Http\Response
     */
    public function show(amsupplier $amsupplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\amsupplier  $amsupplier
     * @return \Illuminate\Http\Response
     */
    public function edit(amsupplier $amsupplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\amsupplier  $amsupplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, amsupplier $amsupplier)
    {
        //
        if ($amsupplier) {

            if ($amsupplier->update($request->toArray())) {
                return response()->json(array_merge([
                        'messages' => trans('data.update', ["data" => $amsupplier->id]),
                        'success' => true,
                    ], $amsupplier->toArray()
                    )
                );
            } else {
                return response()->json(['errors' => $amsupplier->errors()->all()]);
            }
        }
        return response()->json(['errors' => [trans('data.notfound')]]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\amsupplier  $amsupplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(amsupplier $amsupplier)
    {
        //
        if ($amsupplier->delete()) {

            return response()->json(array_merge([
                'messages' => trans('data.destroy', ['rows' => $amsupplier->id . " with id ".$amsupplier->id]),
                'success' => true,
            ],$amsupplier->toArray()));
        } else {
            return response()->json(['errors' => trans('data.destroyfailed', ['data' => $amsupplier->id])]);
        }

    }
}
