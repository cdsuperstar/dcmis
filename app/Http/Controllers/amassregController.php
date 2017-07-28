<?php

namespace App\Http\Controllers;

use App\models\amassreg;
use Illuminate\Http\Request;

class amassregController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datas = amassreg::all();
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
        $rec = new amassreg($request->toArray());
        if ($rec->save()) {
            $rec->amasbudget->regamt=$rec->amasbudget->amt - $rec->amasbudget->amassregs()->sum("amt");
            $rec->amasbudget->save();

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
     * @param  \App\models\amassreg  $amassreg
     * @return \Illuminate\Http\Response
     */
    public function show(amassreg $amassreg)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\amassreg  $amassreg
     * @return \Illuminate\Http\Response
     */
    public function edit(amassreg $amassreg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\amassreg  $amassreg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, amassreg $amassreg)
    {
        //
        if ($amassreg) {

            if ($amassreg->update($request->toArray())) {
                return response()->json(array_merge([
                        'messages' => trans('data.update', ["data" => $amassreg->id]),
                        'success' => true,
                    ], $amassreg->toArray()
                    )
                );
            } else {
                return response()->json(['errors' => $amassreg->errors()->all()]);
            }
        }
        return response()->json(['errors' => [trans('data.notfound')]]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\amassreg  $amassreg
     * @return \Illuminate\Http\Response
     */
    public function destroy(amassreg $amassreg)
    {
        //
        if ($amassreg->delete()) {

            return response()->json(array_merge([
                'messages' => trans('data.destroy', ['rows' => $amassreg->id . " with id ".$amassreg->id]),
                'success' => true,
            ],$amassreg->toArray()));
        } else {
            return response()->json(['errors' => trans('data.destroyfailed', ['data' => $amassreg->id])]);
        }

    }
}
