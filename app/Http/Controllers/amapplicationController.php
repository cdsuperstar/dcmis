<?php

namespace App\Http\Controllers;

use App\models\amapplication;
use Illuminate\Http\Request;
use App\models\amasbudget;
use App\models\amcontrbudget;
use App\models\amsvbudget;
use App\models\amotbudget;
use App\models\ambudgettype;
use Carbon\Carbon;
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

    public function getApplicationProgress(Request $request)
    {
        //
//        $datas = amapplication::limit(1)->orderBy('id','desc')->get(["no"]);
        $sTemplate=ambudgettype::where('template','=','1')->get();
        $datas = amapplication::where('requester','=',$request->user()->id)->where('ambudgettypes_id','=',$sTemplate->id)->get();
        return response()->json($datas);

    }

    public function setStatus(amapplication $amapplication, $field='',$status='',Request $request)
    {
        if($field<>'appstate')return false;

        if($amapplication->update([$field=>$status,'apper'=> $request->user()->id,'appdate'=>Carbon::now()])){
            return response()->json(array_merge([
                    'messages' => trans('data.update', ["data" => $amapplication->id]),
                    'success' => true,
                ], $amapplication->toArray()
                )
            );
        }
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

        if(isset($aAmapplicationsinut["id"])){
            $rec=amapplication::find($aAmapplicationsinut["id"]);
            $rec->fill($aAmapplicationsinut);
        }else{
            $rec = new amapplication($aAmapplicationsinut);
        }
        $rec->save();
        if ($rec) {
            foreach ($aSubs as $k => $v) {
                $cntSub = 0;
                $v['amapplication_id'] = $rec->id;
                switch ($aAmapplicationsinut['templatesign']) {
                    case "1":
                        if(isset($v["id"])){
                            $recSub[$k]=amasbudget::find($v["id"]);
                            $recSub[$k]->fill($v);
                        }else{
                            $recSub[$k]=new amasbudget($v);
                        }
                        break;
                    case "2":
                        if(isset($v["id"])){
                            $recSub[$k]=amasbudget::find($v["id"]);
                            $recSub[$k]->fill($v);
                        }else{
                            $recSub[$k]=new amcontrbudget($v);
                        }
                        break;
                    case "3":
                        if(isset($v["id"])){
                            $recSub[$k]=amasbudget::find($v["id"]);
                            $recSub[$k]->fill($v);
                        }else{
                            $recSub[$k]=new amsvbudget($v);
                        }
                        break;
                    case "4":
                        if(isset($v["id"])){
                            $recSub[$k]=amasbudget::find($v["id"]);
                            $recSub[$k]->fill($v);
                        }else{
                            $recSub[$k]=new amotbudget($v);
                        }
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
