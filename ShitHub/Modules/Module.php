<?php
/**
 * Created by PhpStorm.
 * User: anghenfil
 * Date: 07.05.18
 * Time: 10:09
 */

namespace ShitHub\Modules;


abstract class Module{
    abstract public function call_modul(...$args);
}