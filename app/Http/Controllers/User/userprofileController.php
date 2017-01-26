<?php

namespace App\Http\Controllers\User;

use App\models\userprofile;
use Illuminate\Http\Request;
use App\Http\Requests;
use Storage;
use App\Http\Controllers\Controller;

class userprofileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = userprofile::all();
        return response()->json($datas);
        //
    }

    public function create()
    {
        return view('assets.edition')->with([
            'fields' => User::$angularrules,
            'title' => '信息编辑',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  String $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(String $id)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  String $id
     * @return \Illuminate\Http\Response
     */
    public function show(String $id)
    {
        //
        if ($id == '') {
            return false;
        }

        $userprofile = userprofile::find($id,'id');

        return response()->json($userprofile);
    }

    public function getSelfdata(Request $request)
    {
        //
        $userprofile = userprofile::firstOrCreate(['id' => $request->user()->id]);

        return response()->json($userprofile);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $appUser
     * @return \Illuminate\Http\Response
     */
    public function edit(User $appUser)
    {
        //
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
        $userprofile = userprofile::firstOrCreate(['id' => $request->input('id')]);

        $tmp = $request->input('uploadfile');
        if (is_array($tmp)) {
            $filestring = $tmp['result'];
            $comma = strpos($filestring, ',');
            $filedata = base64_decode(substr($filestring, $comma + 1));
            $disk = Storage::disk('local_public');
            if ($request->input('signpic') <> '') {
                $signpic = str_random(30) . substr($request->input('signpic'), strripos($request->input('signpic'), '.'));
                $request->merge(['signpic' => $signpic]);
            }
        }


        if ($userprofile->update($request->input())) {
            if (is_array($tmp)) $disk->put('/images/users/' . $request->input('id') . '/' . $signpic, $filedata);

            return response()->json([
                'messages' => trans('userprofile.updatesuccess'),
                'success' => true,
                'data' => $userprofile->toJson(),
            ]);
        }

        return response()->json(['errors' => trans('userprofile.nofound')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  String $appUser
     * @return \Illuminate\Http\Response
     */
    public function update(String $id, Request $request)
    {
    }

    public function storeSelfdata(Request $request)
    {
        $request->merge(['id' => $request->user()->id]);
        return $this->postData($request);
    }
}
