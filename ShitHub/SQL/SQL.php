<?php
/**
 * Created by PhpStorm.
 * User: anghenfil
 * Date: 15.05.18
 * Time: 14:17
 */

namespace ShitHub\SQL;


abstract class SQL{
    protected $pdo = null; //pdo object

    public function __construct(){
        try{
            $this->pdo = new \PDO('mysql:host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_NAME'],$_ENV['DB_UNAME'],$_ENV['DB_PW']);
        }catch(\PDOException $e){
            \ShitHub\Core\Loader::getLogger()->alert('PDOException: '.$e->getMessage());
        }
    }

    protected static function offlineErr(){
        die("Database seems to be offline. Please try again later.");
    }
}