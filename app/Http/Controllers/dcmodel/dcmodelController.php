<?php

namespace App\Http\Controllers\dcmodel;

use App\models\dcMdGrp;
use App\models\dcmodel;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Config;
use Log;

class dcmodelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $dcmodel = dcmodel::all();
        return response()->json($dcmodel);
    }

    public function postMovenode(Request $req)
    {
        $pNode = dcMdGrp::where('id', '=', $req->parent)->first();
        $cNode = dcMdGrp::where('id', '=', $req->node['id'])->first();
        $cNode->makeFirstChildOf($pNode);
        for ($i = 0; $i < $req->position; $i++) {
            if ($cNode->getRightSibling() != null)
                $cNode->moveRight();
        }
        return response()->json([
            'messages' => trans('dcmodels.movesuccess', ['cNode' => $cNode->dcmodel->title, 'pNode' => $pNode->dcmodel->title]),
            'success' => true,
            'data' => '',
        ]);
    }

    public function getTree()
    {
        dcMdGrp::rebuild(true);
        $tree = dcMdGrp::leftjoin('dcmodels', 'dcmdgrps.dcmodel_id', '=', 'dcmodels.id')->orderby('dcmdgrps.lft', 'asc')->get(['dcmdgrps.id as id', 'dcmdgrps.parent_id as parent', 'dcmodels.title as text', 'dcmodels.icon', 'dcmdgrps.dcmodel_id as data']);
        foreach ($tree as $node) {
            if ($node->parent == null) {
                $node->parent = '#';
            }

        }
        return response()->json($tree);
    }

    public function getList()
    {
        $datas = dcmodel::all();
        return response()->json($datas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.' . Config::get('app.dctemplate') . '.views.sys-model.edit');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $recData = new dcmodel();
        if ($recData) {

            $recData->fill($request->input());
            if ($request->input('modelcss'))
                $recData->files = $request->input('modelcss');
            $recData->files .= sprintf("views/%s/%s.css,", $request->input('name'), $request->input('name'));
//            if ($request->input('modelscript'))
//                $recData->files .= $request->input('modelscript');
            $recData->files .= sprintf("views/%s/%s.js,", $request->input('name'), $request->input('name'));
            $recData->files .= "js/controllers/GeneralPageController.js,";

            $recData->url = '/' . $request->input('name') . '.html';
            $recData->templateurl = 'dcviews/' . $request->input('name');

            if ($recData->save()) {
//                $recData->makeModel($request->input('template'));
                $md = dcmodel::where('name', '=', $recData->name)->first();

                $pNode = dcMdGrp::where('id', '=', 1)->first();
                $pNode->children()->create(['dcmodel_id' => $md->id]);

                return response()->json(array_merge([
                        'messages' => trans('dcmodels.savesuccess'),
                        'success' => true], $recData->toArray())
                );
            }
        }

        return response()->json(['errors' => $recData->errors()->all()]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        if (!$id) return false;

        $recData = dcmodel::findOrFail($id);
        $oldName = $recData->name;
        if ($recData) {
            foreach ($request->input() as $key => $val) {
                $recData->$key = $val;
            }
            if ($recData->updateUniques()) {
//                $recData->updateModel($oldName);
                return response()->json([
                    'messages' => trans('dcmodels.updatesuccess'),
                    'success' => true,
                    'data' => $recData->toJson(),
                ]);
            } else {
                return response()->json(['errors' => $recData->errors()->all()]);
            }
        }
        return response()->json(['errors' => [trans('dcmodels.nofound')]]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        $aTodel = array();
        $aTmp = json_decode($id);
        if (is_array($aTmp)) {
            $aTodel = $aTmp;
        } else {
            $aTodel[] = $id;
        }

        foreach ($aTodel as $key) {
            $recData = dcmodel::findOrFail($key);
//            $recData->delModel();
        }
        $deletedRows = dcmodel::destroy($aTodel);

        if ($deletedRows) {
            dcMdGrp::rebuild(true);
            return response()->json([
                'messages' => trans('dcmodels.deletesuccess', ['rows' => $deletedRows]),
                'success' => true,
                'data' => $deletedRows,
            ]);
        } else {
            return response()->json(['errors' => trans('dcmodels.nofound')]);
        }
    }

    public function show()
    {
    }

    public function getModTree()
    {
        $mdTreeJson = dcMdGrp::with(['dcmodel' => function ($q) {
            $q->addSelect(array('id', 'name', 'title', 'ismenu', 'icon', 'url', 'templateurl', 'files'));
        }])->get()->tohierarchy();
        return response($mdTreeJson);
    }

    public function getModList()
    {
        $dcModels = dcmodel::where('url', '<>', '')->get();
        return response()->json($dcModels);
    }
}
