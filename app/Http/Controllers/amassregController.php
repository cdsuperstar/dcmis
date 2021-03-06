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
        $amassreg = new amassreg($request->toArray());
        if ($amassreg->save()) {
            $amassreg->amsubbudget->regamt=$amassreg->amsubbudget->amt - $amassreg->amsubbudget->amassregs()->sum("amt");
            $amassreg->amsubbudget->save();

            return response()->json(array_merge([
                    'messages' => trans('data.add', ["data" => $amassreg->id]),
                    'regamt'=>$amassreg->amsubbudget->regamt,
                    'amt'=>$amassreg->amsubbudget->amt,
                    'success' => true,
                ], $amassreg->toArray()
                )
            );
        }
        return response()->json(['errors' => $amassreg->id ]);

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

    public function getLastNo()
    {
        //
        $datas = amassreg::limit(1)->whereNotNull("outbound")->orderBy('outbound','desc')->get(["outbound"]);
        return response()->json($datas);

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
                $amassreg->amsubbudget->regamt=$amassreg->amsubbudget->amt - $amassreg->amsubbudget->amassregs()->sum("amt");
                $amassreg->amsubbudget->save();

                return response()->json(array_merge([
                        'messages' => trans('data.update', ["data" => $amassreg->id]),
                        'regamt'=>$amassreg->amsubbudget->regamt,
                        'amt'=>$amassreg->amsubbudget->amt,
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
            $amassreg->amsubbudget->regamt=$amassreg->amsubbudget->amt - $amassreg->amsubbudget->amassregs()->sum("amt");
            $amassreg->amsubbudget->save();

            return response()->json(array_merge([
                'messages' => trans('data.destroy', ['rows' => $amassreg->id . " with id ".$amassreg->id]),
                'regamt'=>$amassreg->amsubbudget->regamt,
                'amt'=>$amassreg->amsubbudget->amt,
                'success' => true,
            ],$amassreg->toArray()));
        } else {
            return response()->json(['errors' => trans('data.destroyfailed', ['data' => $amassreg->id])]);
        }

    }
}
