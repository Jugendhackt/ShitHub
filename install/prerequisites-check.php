<?php
/**
 * Created by anghenfil.
 * Description: Part of install script. Checks for prerequisites.
 * Date: 18.02.18
 * Time: 11:59
 *
 * Last change by: anghenfil
 */

function checkExtensions(){
    $required_extensions = array("Core", "PDO", "pdo_mysql", "date", "SimpleXML");
    $loaded = get_loaded_extensions(FALSE);
    $ok = true;

    print("<h3>Checking for PHP Extensions:</h3>");
    foreach($required_extensions as $key){
        if(in_array($key, $loaded)){
            print($key." <b style='color: green'>is loaded!</b><br>");
        }else{
            $ok = false;
            print($key." <b style='color: red'>missing.</b><br>");
        }
    }

    return $ok;
}
function checkVersion(){
    print("<h3>Checking PHP Version:</h3>");

    if (version_compare(PHP_VERSION, '7.0.0') >= 0) {
        print("You are running PHP ".PHP_VERSION."! <b style='color: green'>OK</b>");
        return true;
    }elseif (version_compare(PHP_VERSION, '5.3.0') >= 0) {
        print("You are running PHP".PHP_VERSION."! <b style='color: yellow'>You should update PHP, but we can proceed with the installation.</b>");
        return true;
    }elseif (version_compare(PHP_VERSION, '5.0.0', '<=')) {
        print("You are running PHP".PHP_VERSION."! <b style='color: red'>PHP is outdated. Update PHP to proceed.</b>");
        return false;
    }else{
        print("Unable to detect your PHP Version. Maybe you are running PHP".PHP_VERSION."! <b style='color: yellow'>We will try to proceed.</b>");
        return true;
    }
}