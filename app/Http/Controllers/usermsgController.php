<?php

namespace App\Http\Controllers;

use App\models\usermsg;
use App\User;
use Illuminate\Http\Request;
use DB;
use App\models\session;
use Config;
use Carbon\Carbon;

class usermsgController extends Controller
{
    /**
     * Display a listing of the resource.
     * @see Illuminate\Database\Eloquent\Builder
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $theUserid = $request->user()->id;
        $resData = usermsg::where([['recver_id', $theUserid], ['r_delat', null]])->orwhere([['sender_id', $theUserid], ['s_delat', null]])->get();
//        usermsg::where('recver_id',$theUserid)->update(['readtime'=>Carbon::now()]);
        return response()->json($resData);
    }

    public function getMyUnreadCounts(User $user)
    {
        //
        $resData = usermsg::where([
            ['recver_id', '=', $user->id],
            ['readtime', null]
        ])
            ->select(['sender_id', DB::raw('count(sender_id)')])
            ->groupBy(['sender_id'])
            ->orderBy("count", 'desc')
            ->get();
        return response()->json($resData);
    }

    public function getMyChatMsgs(Request $request, User $user)
    {
        //
        DB::table('usermsgs')
            ->where([
                ['recver_id', '=', $request->user()->id],
                ['sender_id', $user->id],
                ['readtime', null],
                ['r_delat', null]
            ])
            ->update(['readtime' => Carbon::now()]);

        $resData = usermsg::where([
            ['recver_id', '=', $request->user()->id],
            ['sender_id', $user->id],
            ['r_delat', null]
        ])
            ->orWhere([
                ['sender_id', '=', $request->user()->id],
                ['recver_id', $user->id],
                ['s_delat', null]
            ])
            ->leftjoin('users as sender', 'sender.id', '=', 'usermsgs.sender_id')
            ->leftjoin('users as recver', 'recver.id', '=', 'usermsgs.recver_id')
            ->orderBy("usermsgs.id", 'desc')
            ->get(['usermsgs.id', 'usermsgs.sender_id', 'usermsgs.recver_id', 'usermsgs.body', 'usermsgs.readtime', 'usermsgs.s_delat', 'usermsgs.r_delat', 'usermsgs.created_at', 'sender.name as sendername', 'recver.name as recvername']);
        return response()->json($resData);
    }

    public function clearMsg(Request $request, User $user)
    {
        DB::table('usermsgs')
            ->where([
                ['recver_id', '=', $request->user()->id],
                ['sender_id', $user->id],
                ['r_delat', null]
            ])
            ->update(['r_delat' => Carbon::now()]);

        DB::table('usermsgs')
            ->where([
                ['sender_id', '=', $request->user()->id],
                ['recver_id', $user->id],
                ['s_delat', null]
            ])
            ->update(['s_delat' => Carbon::now()]);
    }

    public function sendMsg(Request $request)
    {
        //
        $tmpArray = array();
        foreach ($request->input() as $key => $v) {
            $tmpArray = $v;
        }
        $tmpArray["sender_id"] = $request->user()->id;

        $rec = new usermsg($tmpArray);
        if ($rec->save()) {
            $resData = usermsg::where(
                'usermsgs.id', '=', $rec->id
            )
                ->leftjoin('users as sender', 'sender.id', '=', 'usermsgs.sender_id')
                ->leftjoin('users as recver', 'recver.id', '=', 'usermsgs.recver_id')
                ->orderBy("usermsgs.id", 'desc')
                ->get(['usermsgs.id', 'usermsgs.sender_id', 'usermsgs.recver_id', 'usermsgs.body', 'usermsgs.readtime', 'usermsgs.s_delat', 'usermsgs.r_delat', 'usermsgs.created_at', 'sender.name as sendername', 'recver.name as recvername']);

            $msg = (object)null;
            $msg->signpic = "../defaultuser";
            if (isset($msg->sender->userprofile->signpic)) {
                $msg->signpic = $msg->sender->userprofile->signpic;
            }
            $msg->sendername = $rec->sender->name;
            $msg->body = $rec->body;
            $msg->created_at = $rec->created_at->toTimeString();

            event(new \App\Events\eventusermsg($rec->recver_id, $msg));
            event(new \App\Events\usercmd($resData->first()->recver_id,"if(angular.element(\"#msgcontent\").scope().chartMsgs!=undefined){angular.element(\"#msgcontent\").scope().chartMsgs.unshift(".$resData->first()->toJson().");}"));

            return response()->json($resData);
        }
    }

    public function getUnreadMsgs(Request $request)
    {
        $recData = usermsg::where([
            ['recver_id', $request->user()->id],
            ['readtime', null],
            ['r_delat', null]
        ])
            ->leftjoin('users', 'users.id', '=', 'usermsgs.sender_id')
            ->leftjoin('userprofiles', 'userprofiles.id', '=', 'usermsgs.sender_id')
            ->leftjoin('users as b', 'b.id', '=', 'usermsgs.recver_id')
            ->orderBy('usermsgs.id', 'desc')
            ->get(['usermsgs.id', 'sender_id', 'userprofiles.signpic as signpic', 'users.name as sendername', 'usermsgs.body as body', 'usermsgs.created_at as created_at']);
        foreach ($recData as $oBject) {
            if (is_null($oBject->signpic)) {
                $oBject->signpic = "../defaultuser";
            }
        }
        return response()->json($recData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('home.' . Config::get('app.dctemplate') . '.views.sys-msg.edit');

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
        $rec = new usermsg($request->toArray());
        if ($rec) {
            // 如果在线发消息
            if (session::where('user_id', $rec->recver_id)->count() > 0) {
                $msg = (object)null;
                $msg->sender_id = $rec->sender_id;
                $msg->sendername = $rec->sender->name;
                $msg->body = $rec->body;
                $msg->created_at = $rec->created_at->toTimeString();
                event(new \App\Events\usermsg($rec->recver_id, $msg));
            }
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
     * @param  \App\models\usermsg $usermsg
     * @return \Illuminate\Http\Response
     */
    public function show(usermsg $usermsg)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\usermsg $usermsg
     * @return \Illuminate\Http\Response
     */
    public function edit(usermsg $usermsg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\models\usermsg $usermsg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, usermsg $usermsg)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\usermsg $usermsg
     * @return \Illuminate\Http\Response
     */
    public function destroy(usermsg $usermsg, Request $request)
    {
        //
        $theUserid = $request->user()->id;
        if ($usermsg->recver_id == $theUserid) {
            $usermsg->r_delat = Carbon::now();
        } elseif ($usermsg->sender_id == $theUserid) {
            $usermsg->s_delat = Carbon::now();
        }

        if ($usermsg->save()) {
            if ($usermsg->r_delat && $usermsg->s_delat) {
                $usermsg->delete();
            }
            return response()->json(array_merge([
                'messages' => trans('data.destroy', ['data' => $usermsg->id]),
                'success' => true,
            ], $usermsg->toArray()));
        } else {
            return response()->json(['errors' => trans('data.destroy', ['data' => $usermsg->id])]);
        }
    }
}
