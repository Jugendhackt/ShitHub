<?php
/**
 * Created by anghenfil.
 * Description: Install script for ShitHub
 * Date: 18.02.18
 * Time: 11:53
 *
 * Last change by: anghenfil
 */
if(!defined(SECURITY)){
    die();
}

if(!isset($_POST['installform'])){ //If form wasn't submitted, show form
    print('<!DOCTYPE html>
<html>
<body>

<h1>ShitHub Installation</h1>');

    if(!isset($_GET['step2'])) {
        //Check for prerequisites
        require_once("prerequisites-check.php");
        print("<h2>Check for prerequisites:</h2>");
        if (!checkVersion() || !checkExtensions()) {
            print("<h2 style='color: red'>You should fulfill the prerequisites to proceed. However, if you know what you do, you can try to proceed the installation anyway.</h2>");
            print("<form action='#' method='get'><button type='submit' name='step2'>Proceed anyway</button></form>");
        } else {
            print("<form action='#' method='get'><button type='submit' name='step2'>Proceed</button></form>");
        }
    }else{
        require_once("form.php");
    }
}else{

}