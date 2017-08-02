<?php

namespace App\Http\Controllers;

use App\models\dcannouncement;
use Illuminate\Http\Request;
use App\User;


class dcannouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datas = dcannouncement::all();
        return response()->json($datas);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $rec = new dcannouncement(array_merge( $request->toArray(),['user_id'=>$request->user()->id]));
        if ($rec->save()) {
            broadcast(new \App\Events\normal($request->user()->name.":".$rec->body));
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
     * @param  \App\models\dcannouncement  $dcannouncement
     * @return \Illuminate\Http\Response
     */
    public function show(dcannouncement $dcannouncement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\dcannouncement  $dcannouncement
     * @return \Illuminate\Http\Response
     */
    public function edit(dcannouncement $dcannouncement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\dcannouncement  $dcannouncement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, dcannouncement $dcannouncement)
    {
        //
        if ($dcannouncement) {

            if ($dcannouncement->update($request->toArray())) {
                return response()->json(array_merge([
                        'messages' => trans('data.update', ["data" => $dcannouncement->id]),
                        'success' => true,
                    ], $dcannouncement->toArray()
                    )
                );
            } else {
                return response()->json(['errors' => $dcannouncement->errors()->all()]);
            }
        }
        return response()->json(['errors' => [trans('data.notfound')]]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\dcannouncement  $dcannouncement
     * @return \Illuminate\Http\Response
     */
    public function destroy(dcannouncement $dcannouncement)
    {
        //
        if ($dcannouncement->delete()) {

            return response()->json(array_merge([
                'messages' => trans('data.destroy', ['rows' => $dcannouncement->id . " with id ".$dcannouncement->id]),
                'success' => true,
            ],$dcannouncement->toArray()));
        } else {
            return response()->json(['errors' => trans('data.destroyfailed', ['data' => $dcannouncement->id])]);
        }

    }
}
