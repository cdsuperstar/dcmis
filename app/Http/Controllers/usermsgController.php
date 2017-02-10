<?php

namespace App\Http\Controllers;

use App\models\usermsg;
use Illuminate\Http\Request;
use Config;

class usermsgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $resData = usermsg::all();
        return response()->json($resData);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('home.'.Config::get('app.dctemplate').'.views.sys-msg.edit');

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
        $rec = new usermsg($request->toArray());
        if ($rec) {
            return response()->json(array_merge([
                    'messages' => trans('data.add', ["data" => $rec->id]),
                    'success' => true,
                ], $rec->toArray()
                )
            );
        }
        return response()->json(['errors' => $rec->errors()->all()]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\usermsg  $usermsg
     * @return \Illuminate\Http\Response
     */
    public function show(usermsg $usermsg)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\usermsg  $usermsg
     * @return \Illuminate\Http\Response
     */
    public function edit(usermsg $usermsg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\usermsg  $usermsg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, usermsg $usermsg)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\usermsg  $usermsg
     * @return \Illuminate\Http\Response
     */
    public function destroy(usermsg $usermsg)
    {
        //
        if ($usermsg->delete()) {

            return response()->json(array_merge([
                'messages' => trans('data.destroy', ['data' => $usermsg->id]),
                'success' => true,
            ],$usermsg->toArray()));
        } else {
            return response()->json(['errors' => trans('data.destroy', ['data' => $usermsg->id])]);
        }

    }
}
