<?php
/**
 * Created by PhpStorm.
 * User: anghenfil
 * Date: 12.05.18
 * Time: 13:45
 */

namespace ShitHub\Modules;


class codeviewer extends Module{

    public function call_modul(...$args){
        $cw = new \ShitHub\CodeViewer\CodeViewer();
    }
}