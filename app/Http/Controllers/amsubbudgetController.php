<?php

namespace App\Http\Controllers;

use App\models\ambudgettype;
use App\models\amsubbudget;
use Illuminate\Http\Request;
use App\models\amassreg;
use App\models\amapplication;

class amsubbudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datas = amsubbudget::all();
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
     * 得到登记资产列表
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAssReg()
    {
        //
        $ambudgettype=ambudgettype::whereTemplate("1")->get()->first();
        $datas = amsubbudget::with(['amassregs', 'ambaseas'])
            ->whereHas('amapplication', function($query) use ($ambudgettype) {
                $query->where('ambudgettypes_id',$ambudgettype->id);
            })
            ->get();
        return response()->json($datas);

    }

    public function getTheAssReg(amsubbudget $amsubbudget)
    {
        //
        $datas = collect([amsubbudget::with(['amassregs'])->find($amsubbudget->id)]);
        return response()->json($datas);

    }

    public function getAppAss()
    {
        //
        $ambudgettype=ambudgettype::whereTemplate("1")->get()->first();
        $datas = amsubbudget::with([
            'amapplication',
            'ambaseas'
        ])
            ->whereHas('amapplication', function($query) use ($ambudgettype) {
                $query->where('ambudgettypes_id',$ambudgettype->id);
            })
            ->get();
        return response()->json($datas);

    }

    public function getAssScrap()
    {
        //
//        $datas = amsubbudget::with(['amassscraps', 'ambaseas'])->get();
//        return response()->json($datas);

    }

    public function getAssToScrap()
    {
        //
        $datas = amassreg::with(['amsubbudget.ambaseas'])
            ->get();
        return response()->json($datas);

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
        $rec = new amsubbudget($request->toArray());
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

    public function setStatus(amsubbudget $amsubbudget, $field = '', $status = '')
    {
        //

        if ($field <> 'purchway' && $field <> 'purchstate' && $field <> 'reimstate' && $field <> 'asstate') return false;
        $amsubbudget->fill([$field => $status]);

        if ($field == 'purchstate' && $status == "已采购")
            $amsubbudget->regamt = $amsubbudget->amt - $amsubbudget->amassregs()->sum("amt");

        if ($amsubbudget->save()) {
            $tmpProgress = '';
            if ($field == 'purchstate') {
                $resAmapp = $amsubbudget->amapplication;
                $resAmapp->progress = '' . $amsubbudget->amapplication->amsubbudgets()->where(['purchstate' => '已采购'])->count() . '/' . $amsubbudget->amapplication->amsubbudgets()->count();
                $tmpProgress = $resAmapp->progress;
                $resAmapp->save();
            }
            return response()->json(array_merge([
                    'messages' => trans('data.update', ["data" => $amsubbudget->id]),
                    'progress' => $tmpProgress,
                    'success' => true,
                ], $amsubbudget->toArray()
                )
            );
        }

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\models\amsubbudget  $amsubbudget
     * @return \Illuminate\Http\Response
     */
    public function show(amsubbudget $amsubbudget)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\amsubbudget  $amsubbudget
     * @return \Illuminate\Http\Response
     */
    public function edit(amsubbudget $amsubbudget)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\amsubbudget  $amsubbudget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, amsubbudget $amsubbudget)
    {
        //
        if ($amsubbudget) {

            if ($amsubbudget->update($request->toArray())) {
                return response()->json(array_merge([
                        'messages' => trans('data.update', ["data" => $amsubbudget->id]),
                        'success' => true,
                    ], $amsubbudget->toArray()
                    )
                );
            } else {
                return response()->json(['errors' => $amsubbudget->errors()->all()]);
            }
        }
        return response()->json(['errors' => [trans('data.notfound')]]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\amsubbudget  $amsubbudget
     * @return \Illuminate\Http\Response
     */
    public function destroy(amsubbudget $amsubbudget)
    {
        //
        if ($amsubbudget->delete()) {

            return response()->json(array_merge([
                'messages' => trans('data.destroy', ['rows' => $amsubbudget->id . " with id " . $amsubbudget->id]),
                'success' => true,
            ], $amsubbudget->toArray()));
        } else {
            return response()->json(['errors' => trans('data.destroyfailed', ['data' => $amsubbudget->id])]);
        }

    }
}
