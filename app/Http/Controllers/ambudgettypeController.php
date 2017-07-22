<?php

namespace App\Http\Controllers;

use App\models\ambudgettype;
use Illuminate\Http\Request;

class ambudgettypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datas = ambudgettype::all();
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
        $rec = new ambudgettype($request->toArray());
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
     * @param  \App\models\ambudgettype  $ambudgettype
     * @return \Illuminate\Http\Response
     */
    public function show(ambudgettype $ambudgettype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\ambudgettype  $ambudgettype
     * @return \Illuminate\Http\Response
     */
    public function edit(ambudgettype $ambudgettype)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\ambudgettype  $ambudgettype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ambudgettype $ambudgettype)
    {
        //
        if ($ambudgettype) {

            if ($ambudgettype->update($request->toArray())) {
                return response()->json(array_merge([
                        'messages' => trans('data.update', ["data" => $ambudgettype->id]),
                        'success' => true,
                    ], $ambudgettype->toArray()
                    )
                );
            } else {
                return response()->json(['errors' => $ambudgettype->errors()->all()]);
            }
        }
        return response()->json(['errors' => [trans('data.notfound')]]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\ambudgettype  $ambudgettype
     * @return \Illuminate\Http\Response
     */
    public function destroy(ambudgettype $ambudgettype)
    {
        //
        if ($ambudgettype->delete()) {

            return response()->json(array_merge([
                'messages' => trans('data.destroy', ['rows' => $ambudgettype->id . " with id ".$ambudgettype->id]),
                'success' => true,
            ],$ambudgettype->toArray()));
        } else {
            return response()->json(['errors' => trans('data.destroyfailed', ['data' => $ambudgettype->id])]);
        }

    }
}
