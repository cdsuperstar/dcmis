<?php

namespace App\Http\Controllers;

use App\models\amasbudget;
use App\models\amassreg;
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
     * 得到登记资产列表
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAssReg()
    {
        //
        $datas = amasbudget::with(['amassregs', 'ambaseas'])->get();
        return response()->json($datas);

    }

    public function getTheAssReg(amasbudget $amasbudget)
    {
        //
        $datas = collect([amasbudget::with(['amassregs'])->find($amasbudget->id)]);
        return response()->json($datas);

    }

    public function getAppAss()
    {
        //
        $datas = amasbudget::with(['amapplication', 'ambaseas'])->get();
        return response()->json($datas);

    }

    public function getAssScrap()
    {
        //
//        $datas = amasbudget::with(['amassscraps', 'ambaseas'])->get();
//        return response()->json($datas);

    }

    public function getAssToScrap()
    {
        //
        $datas = amassreg::with(['amasbudget.ambaseas'])->get();
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
     * @param  \Illuminate\Http\Request $request
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
        return response()->json(['errors' => $rec->id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\amasbudget $amasbudget
     * @return \Illuminate\Http\Response
     */
    public function show(amasbudget $amasbudget)
    {
        //

    }

    public function setStatus(amasbudget $amasbudget, $field = '', $status = '')
    {
        //
        if ($field <> 'purchway' && $field <> 'purchstate' && $field <> 'reimstate' && $field <> 'asstate') return false;
        $amasbudget->fill([$field => $status]);

        if ($field == 'purchstate' && $status == "已采购")
            $amasbudget->regamt = $amasbudget->amt - $amasbudget->amassregs()->sum("amt");

        if ($amasbudget->save()) {
            $tmpProgress = '';
            if ($field == 'purchstate') {
                $resAmapp = $amasbudget->amapplication;
                $resAmapp->progress = '' . $amasbudget->amapplication->amasbudgets()->where(['purchstate' => '已采购'])->count() . '/' . $amasbudget->amapplication->amasbudgets()->count();
                $tmpProgress = $resAmapp->progress;
                $resAmapp->save();
            }
            return response()->json(array_merge([
                    'messages' => trans('data.update', ["data" => $amasbudget->id]),
                    'progress' => $tmpProgress,
                    'success' => true,
                ], $amasbudget->toArray()
                )
            );
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\amasbudget $amasbudget
     * @return \Illuminate\Http\Response
     */
    public function edit(amasbudget $amasbudget)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\models\amasbudget $amasbudget
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
     * @param  \App\models\amasbudget $amasbudget
     * @return \Illuminate\Http\Response
     */
    public function destroy(amasbudget $amasbudget)
    {
        //
        if ($amasbudget->delete()) {

            return response()->json(array_merge([
                'messages' => trans('data.destroy', ['rows' => $amasbudget->id . " with id " . $amasbudget->id]),
                'success' => true,
            ], $amasbudget->toArray()));
        } else {
            return response()->json(['errors' => trans('data.destroyfailed', ['data' => $amasbudget->id])]);
        }

    }
}
