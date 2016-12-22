<?php

namespace App\models;

//use LaravelBook\Ardent\Ardent;
use LaravelArdent\Ardent\Ardent;
use File;

/**
 * Class dcmodel
 * @package App\models
 */
class dcmodel extends Ardent
{
    //
    public static $rules = array(
        'name' => 'required',
        'title' => 'required',
        'ismenu' => 'required',
        'icon' => '',
        'url' => '',
        'templateurl' => '',
        'files' => '',
    );
    public static $angularrules = array(
        'name' => 'required',
        'title' => 'required',
        'ismenu' => 'required',
        'icon' => '',
        'url' => '',
        'templateurl' => '',
        'files' => '',
    );


    /**
     * @var string
     */
    protected $table = 'dcmodels';
    protected $fillable = ['name', 'title', 'ismenu', 'icon', 'url', 'templateurl', 'files'];

    public function makeModel($sTemp = "default")
    {
        $tempBase = storage_path() . "/template/$sTemp";
        $bladeDir = base_path() . "/resources/views/style/$sTemp/views/" . $this->name;
        $viewDir = public_path() . "/views/" . $this->name;
        $viewCss = $viewDir . "/" . $this->name . ".css";
        $viewJs = $viewDir . "/" . $this->name . ".js";

        if ($this->url && is_dir($tempBase)) {
            File::makeDirectory($bladeDir);
            File::makeDirectory($viewDir);

            File::copy($tempBase . "/view/model.css", $viewCss);
            File::copy($tempBase . "/view/model.js", $viewJs);
            File::copy($tempBase . "/model.blade.php", $bladeDir . "/" . $this->name . ".blade.php");
        }
    }

    public function updateModel($oldName, $sTemp = "default")
    {
        if ($oldName == $this->name) return false;
        $bladeDir = base_path() . "/resources/views/style/$sTemp/views/" . $oldName;
        $viewDir = public_path() . "/views/" . $oldName;

        $newbladeDir = base_path() . "/resources/views/style/$sTemp/views/" . $this->name;
        $newviewDir = public_path() . "/views/" . $this->name;

        if ($this->name) {
            File::move($bladeDir, $newbladeDir);
            File::move($viewDir, $newviewDir);

            File::move($newviewDir . "/" . $oldName . ".css", $newviewDir . "/" . $this->name . ".css");
            File::move($newviewDir . "/" . $oldName . ".js", $newviewDir . "/" . $this->name . ".js");
            File::move($newbladeDir . "/" . $oldName . ".blade.php", $newbladeDir . "/" . $this->name . ".blade.php");
        }
    }

    public function delModel($sTemp = "default")
    {
        $bladeDir = base_path() . "/resources/views/style/$sTemp/views/" . $this->name;
        $viewDir = public_path() . "/views/" . $this->name;

        if ($this->name <> '' && (is_dir($viewDir) || is_dir($bladeDir))) {
            File::deleteDirectory($bladeDir);
            File::deleteDirectory($viewDir);
        }
    }

    /**
     *
     * @return string
     */
    public function dcmdgrp()
    {
        return $this->hasOne('App\models\dcMdGrp');
    }
}
