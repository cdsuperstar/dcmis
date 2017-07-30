<?php

namespace App\Http\Controllers;

use App\models\dcmatter;
use Illuminate\Http\Request;

class dcmatterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datas = dcmatter::all();
        return response()->json($datas);
    }

    public function getMySendIndex(Request $request)
    {
        //
        $datas = dcmatter::where('suser_id','=',$request->user()->id);
        return response()->json($datas);
    }

    public function getMyRecIndex(Request $request)
    {
        //
        $datas = dcmatter::where('ruser_id','=',$request->user()->id);
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
        $rec = new dcmatter($request->toArray());
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
     * @param  \App\models\dcmatter  $dcmatter
     * @return \Illuminate\Http\Response
     */
    public function show(dcmatter $dcmatter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\dcmatter  $dcmatter
     * @return \Illuminate\Http\Response
     */
    public function edit(dcmatter $dcmatter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\dcmatter  $dcmatter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, dcmatter $dcmatter)
    {
        //
        if ($dcmatter) {

            if ($dcmatter->update($request->toArray())) {
                return response()->json(array_merge([
                        'messages' => trans('data.update', ["data" => $dcmatter->id]),
                        'success' => true,
                    ], $dcmatter->toArray()
                    )
                );
            } else {
                return response()->json(['errors' => $dcmatter->errors()->all()]);
            }
        }
        return response()->json(['errors' => [trans('data.notfound')]]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\dcmatter  $dcmatter
     * @return \Illuminate\Http\Response
     */
    public function destroy(dcmatter $dcmatter)
    {
        //
        if ($dcmatter->delete()) {

            return response()->json(array_merge([
                'messages' => trans('data.destroy', ['rows' => $dcmatter->id . " with id ".$dcmatter->id]),
                'success' => true,
            ],$dcmatter->toArray()));
        } else {
            return response()->json(['errors' => trans('data.destroyfailed', ['data' => $dcmatter->id])]);
        }

    }
}
