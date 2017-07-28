<?php

namespace App\Http\Controllers;

use App\models\amcontrbudget;
use Illuminate\Http\Request;

class amcontrbudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datas = amcontrbudget::all();
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
        $rec = new amcontrbudget($request->toArray());
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
     * @param  \App\models\amcontrbudget  $amcontrbudget
     * @return \Illuminate\Http\Response
     */
    public function show(amcontrbudget $amcontrbudget)
    {
        //
    }

    public function setStatus(amcontrbudget $amcontrbudget, $field='',$status='')
    {
        //
        if($field<>'purchway'&&$field<>'purchstate'&&$field<>'reimstate')return false;

        if($amcontrbudget->update([$field=>$status])){
            return response()->json(array_merge([
                    'messages' => trans('data.update', ["data" => $amcontrbudget->id]),
                    'success' => true,
                ], $amcontrbudget->toArray()
                )
            );
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\amcontrbudget  $amcontrbudget
     * @return \Illuminate\Http\Response
     */
    public function edit(amcontrbudget $amcontrbudget)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\amcontrbudget  $amcontrbudget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, amcontrbudget $amcontrbudget)
    {
        //
        if ($amcontrbudget) {

            if ($amcontrbudget->update($request->toArray())) {
                return response()->json(array_merge([
                        'messages' => trans('data.update', ["data" => $amcontrbudget->id]),
                        'success' => true,
                    ], $amcontrbudget->toArray()
                    )
                );
            } else {
                return response()->json(['errors' => $amcontrbudget->errors()->all()]);
            }
        }
        return response()->json(['errors' => [trans('data.notfound')]]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\amcontrbudget  $amcontrbudget
     * @return \Illuminate\Http\Response
     */
    public function destroy(amcontrbudget $amcontrbudget)
    {
        //
        if ($amcontrbudget->delete()) {

            return response()->json(array_merge([
                'messages' => trans('data.destroy', ['rows' => $amcontrbudget->id . " with id ".$amcontrbudget->id]),
                'success' => true,
            ],$amcontrbudget->toArray()));
        } else {
            return response()->json(['errors' => trans('data.destroyfailed', ['data' => $amcontrbudget->id])]);
        }

    }
}
