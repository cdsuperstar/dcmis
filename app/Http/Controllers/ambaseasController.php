<?php

namespace App\Http\Controllers;

use App\models\ambaseas;
use Illuminate\Http\Request;

class ambaseasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datas = ambaseas::all();
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
        $rec = new ambaseas($request->toArray());
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
     * @param  \App\models\ambaseas  $ambaseas
     * @return \Illuminate\Http\Response
     */
    public function show(ambaseas $ambaseas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\ambaseas  $ambaseas
     * @return \Illuminate\Http\Response
     */
    public function edit(ambaseas $ambaseas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\ambaseas  $ambaseas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ambaseas $ambaseas)
    {
        //
        if ($ambaseas) {

            if ($ambaseas->update($request->toArray())) {
                return response()->json(array_merge([
                        'messages' => trans('data.update', ["data" => $ambaseas->id]),
                        'success' => true,
                    ], $ambaseas->toArray()
                    )
                );
            } else {
                return response()->json(['errors' => $ambaseas->errors()->all()]);
            }
        }
        return response()->json(['errors' => [trans('data.notfound')]]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\ambaseas  $ambaseas
     * @return \Illuminate\Http\Response
     */
    public function destroy(ambaseas $ambaseas)
    {
        //
        if ($ambaseas->delete()) {

            return response()->json(array_merge([
                'messages' => trans('data.destroy', ['rows' => $ambaseas->id . " with id ".$ambaseas->id]),
                'success' => true,
            ],$ambaseas->toArray()));
        } else {
            return response()->json(['errors' => trans('data.destroyfailed', ['data' => $ambaseas->id])]);
        }

    }
}
