<?php

namespace App\Http\Controllers;

use App\models\amasbudget;
use Illuminate\Http\Request;

class amasbudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datas = amasbudget::all();
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
        $rec = new amasbudget($request->toArray());
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
     * @param  \App\models\amasbudget  $amasbudget
     * @return \Illuminate\Http\Response
     */
    public function show(amasbudget $amasbudget)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\amasbudget  $amasbudget
     * @return \Illuminate\Http\Response
     */
    public function edit(amasbudget $amasbudget)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\amasbudget  $amasbudget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, amasbudget $amasbudget)
    {
        //
        if ($amasbudget) {

            if ($amasbudget->update($request->toArray())) {
                return response()->json(array_merge([
                        'messages' => trans('data.update', ["data" => $amasbudget->id]),
                        'success' => true,
                    ], $amasbudget->toArray()
                    )
                );
            } else {
                return response()->json(['errors' => $amasbudget->errors()->all()]);
            }
        }
        return response()->json(['errors' => [trans('data.notfound')]]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\amasbudget  $amasbudget
     * @return \Illuminate\Http\Response
     */
    public function destroy(amasbudget $amasbudget)
    {
        //
        if ($amasbudget->delete()) {

            return response()->json(array_merge([
                'messages' => trans('data.destroy', ['rows' => $amasbudget->id . " with id ".$amasbudget->id]),
                'success' => true,
            ],$amasbudget->toArray()));
        } else {
            return response()->json(['errors' => trans('data.destroyfailed', ['data' => $amasbudget->id])]);
        }

    }
}
