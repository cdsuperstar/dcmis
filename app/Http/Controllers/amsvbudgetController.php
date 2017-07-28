<?php

namespace App\Http\Controllers;

use App\models\amsvbudget;
use Illuminate\Http\Request;

class amsvbudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datas = amsvbudget::all();
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
        $rec = new amsvbudget($request->toArray());
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
     * @param  \App\models\amsvbudget  $amsvbudget
     * @return \Illuminate\Http\Response
     */
    public function show(amsvbudget $amsvbudget)
    {
        //
    }

    public function setStatus(amsvbudget $amsvbudget, $field='',$status='')
    {
        //
        if($field<>'purchway'&&$field<>'purchstate'&&$field<>'reimstate')return false;

        if($amsvbudget->update([$field=>$status])){
            return response()->json(array_merge([
                    'messages' => trans('data.update', ["data" => $amsvbudget->id]),
                    'success' => true,
                ], $amsvbudget->toArray()
                )
            );
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\amsvbudget  $amsvbudget
     * @return \Illuminate\Http\Response
     */
    public function edit(amsvbudget $amsvbudget)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\amsvbudget  $amsvbudget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, amsvbudget $amsvbudget)
    {
        //
        if ($amsvbudget) {

            if ($amsvbudget->update($request->toArray())) {
                return response()->json(array_merge([
                        'messages' => trans('data.update', ["data" => $amsvbudget->id]),
                        'success' => true,
                    ], $amsvbudget->toArray()
                    )
                );
            } else {
                return response()->json(['errors' => $amsvbudget->errors()->all()]);
            }
        }
        return response()->json(['errors' => [trans('data.notfound')]]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\amsvbudget  $amsvbudget
     * @return \Illuminate\Http\Response
     */
    public function destroy(amsvbudget $amsvbudget)
    {
        //
        if ($amsvbudget->delete()) {

            return response()->json(array_merge([
                'messages' => trans('data.destroy', ['rows' => $amsvbudget->id . " with id ".$amsvbudget->id]),
                'success' => true,
            ],$amsvbudget->toArray()));
        } else {
            return response()->json(['errors' => trans('data.destroyfailed', ['data' => $amsvbudget->id])]);
        }

    }
}
