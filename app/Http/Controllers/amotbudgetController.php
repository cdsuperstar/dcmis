<?php

namespace App\Http\Controllers;

use App\models\amotbudget;
use Illuminate\Http\Request;

class amotbudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datas = amotbudget::all();
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
     * @param  \App\models\amotbudget  $amotbudget
     * @return \Illuminate\Http\Response
     */
    public function show(amotbudget $amotbudget)
    {
        //
    }

    public function setStatus(amotbudget $amotbudget, $field='',$status='')
    {
        //
        if($field<>'purchway'&&$field<>'purchstate'&&$field<>'reimstate')return false;

        if($amotbudget->update([$field=>$status])){
            return response()->json(array_merge([
                    'messages' => trans('data.update', ["data" => $amotbudget->id]),
                    'success' => true,
                ], $amotbudget->toArray()
                )
            );
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\amotbudget  $amotbudget
     * @return \Illuminate\Http\Response
     */
    public function edit(amotbudget $amotbudget)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\amotbudget  $amotbudget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, amotbudget $amotbudget)
    {
        //
        if ($amotbudget) {

            if ($amotbudget->update($request->toArray())) {
                return response()->json(array_merge([
                        'messages' => trans('data.update', ["data" => $amotbudget->id]),
                        'success' => true,
                    ], $amotbudget->toArray()
                    )
                );
            } else {
                return response()->json(['errors' => $amotbudget->errors()->all()]);
            }
        }
        return response()->json(['errors' => [trans('data.notfound')]]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\amotbudget  $amotbudget
     * @return \Illuminate\Http\Response
     */
    public function destroy(amotbudget $amotbudget)
    {
        //
        if ($amotbudget->delete()) {

            return response()->json(array_merge([
                'messages' => trans('data.destroy', ['rows' => $amotbudget->id . " with id ".$amotbudget->id]),
                'success' => true,
            ],$amotbudget->toArray()));
        } else {
            return response()->json(['errors' => trans('data.destroyfailed', ['data' => $amotbudget->id])]);
        }

    }
}
