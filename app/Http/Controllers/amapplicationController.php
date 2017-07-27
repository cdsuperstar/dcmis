<?php

namespace App\Http\Controllers;

use App\models\amapplication;
use Illuminate\Http\Request;
use App\models\amasbudget;
use App\models\amcontrbudget;
use App\models\amsvbudget;
use App\models\amotbudget;
use Illuminate\Support\Facades\Log;


class amapplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datas = amapplication::all();
        return response()->json($datas);

    }

    public function getLastNo()
    {
        //
        $datas = amapplication::limit(1)->orderBy('id','desc')->get(["no"]);
        return response()->json($datas);

    }

    public function getSubsFromAppID(amapplication $amapplication)
    {
        //
        switch ($amapplication->ambudgettypes_id) {
            case 1:
                $datas = $amapplication->amasbudgets();
                break;
            case 2:
                $datas = $amapplication->amcontrbudgets();
                break;
            case 3:
                $datas = $amapplication->amsvbudgets();
                break;
            case 4:
                $datas = $amapplication->amotbudgets();
                break;
        }

        return response()->json($datas->get());

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
        $rec = new amapplication($request->toArray());
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeReq(Request $request)
    {
        $aAmapplicationsinut = array();
        $aSubs = array();
        foreach ($request->input() as $k => $v) {
            if (is_array($v)) {
                $aSubs[$k] = $v;
            } else {
                $aAmapplicationsinut[$k] = $v;
            }
        }

        isset($aAmapplicationsinut["id"])?$rec=amapplication::updateOrCreate($aAmapplicationsinut):$rec = new amapplication($aAmapplicationsinut);
        $rec->save();
        \Log::info($rec);
        if ($rec) {
            foreach ($aSubs as $k => $v) {
                $cntSub = 0;
                $v['amapplication_id'] = $rec->id;
                switch ($aAmapplicationsinut['templatesign']) {
                    case "1":
                        isset($v["id"])? $recSub[$k] = amasbudget::updateOrCreate($v):$recSub[$k]=new amasbudget($v);
                        break;
                    case "2":
                        isset($v["id"])? $recSub[$k] = amcontrbudget::updateOrCreate($v):$recSub[$k]=new amcontrbudget($v);
                        break;
                    case "3":
                        isset($v["id"])? $recSub[$k] = amsvbudget::updateOrCreate($v):$recSub[$k]=new amsvbudget($v);
                        break;
                    case "4":
                        isset($v["id"])? $recSub[$k] = amotbudget::updateOrCreate($v):$recSub[$k]=new amotbudget($v);
                        break;
                }
                if ($recSub[$k]->save()) $cntSub++;

            }

            return response()->json(array_merge([
                    'messages' => trans('data.add', ["data" => $rec->id]) . "($cntSub subs)",
                    'success' => true,
                ], $rec->toArray()
                )
            );
        }
        return response()->json(['errors' => $rec->toJson()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\amapplication $amapplication
     * @return \Illuminate\Http\Response
     */
    public function show(amapplication $amapplication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\amapplication $amapplication
     * @return \Illuminate\Http\Response
     */
    public function edit(amapplication $amapplication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\models\amapplication $amapplication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, amapplication $amapplication)
    {
        //
        if ($amapplication) {

            if ($amapplication->update($request->toArray())) {
                return response()->json(array_merge([
                        'messages' => trans('data.update', ["data" => $amapplication->id]),
                        'success' => true,
                    ], $amapplication->toArray()
                    )
                );
            } else {
                return response()->json(['errors' => $amapplication->errors()->all()]);
            }
        }
        return response()->json(['errors' => [trans('data.notfound')]]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\amapplication $amapplication
     * @return \Illuminate\Http\Response
     */
    public function destroy(amapplication $amapplication)
    {
        //
        if ($amapplication->delete()) {

            return response()->json(array_merge([
                'messages' => trans('data.destroy', ['rows' => $amapplication->id . " with id " . $amapplication->id]),
                'success' => true,
            ], $amapplication->toArray()));
        } else {
            return response()->json(['errors' => trans('data.destroyfailed', ['data' => $amapplication->id])]);
        }
    }
}
