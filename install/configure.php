<?php
/**
 * Created by anghenfil.
 * Description: Part of install script;
 * Date: 20.02.18
 * Time: 09:08
 *
 * Last change by: anghenfil
 */

$form = "<form action=\"#\" method=\"post\">
    <p>Debug-Level: </p>
    <select name=\"debuglevel\">
        <option value=\"debug\">Debug</option>
        <option value=\"info\">Info</option>
        <option value=\"notice\">Notice</option>
        <option value=\"warning\">Warning</option>
        <option value=\"error\">Error</option>
        <option value=\"critical\">Critical</option>
        <option value=\"alert\">Alert</option>
        <option value=\"emergency\">Emergency</option>
    </select>
    <p>Upload DIR</p>
    <input type='text' size='75' name=\"uploaddir\" value=".dirname(__DIR__)."/data/upload>
    <p>Log location</p>
    <input type='text' size='75' name=\"loglocation\" value=".dirname(__DIR__)."/data/log>
    <p>Config location with filename (IMPORTANT: OUT OF WEBROOT!)</p>
    <input type='text' size='75' name=\"configlocation\">
    <button type='submit' name='configureform'>Proceed</button>
</form>";

if(!isset($_POST['configureform'])){
    print($form);
}else{
    if(empty($_POST['loglocation']) || empty($_POST['uploaddir']) || empty($_POST['debuglevel']) || empty($_POST['loglocation']) || empty('configlocation')){
        print($form);
    }else{
        if(!copy(__DIR__."/default_config", $_POST['configlocation'])){
            print("<b style='color: red'>Couldn't create config. Please check permissions.</b>");
            print($form);
        }else{
            error_reporting(E_ALL);
            $indexphp = file_get_contents("index.php");
            $indexphp = str_replace("{CONFIGPATH}", $_POST['configlocation'], $indexphp);
            file_put_contents("index.php", $indexphp);

            $writedata = "";

            $writedata .= "\nUPLOAD_DIR = ".$_POST['uploaddir'];
            $writedata .= "\nLOG_LOCATION = ".$_POST['loglocation'];
            //TODO: Write rest of config
            header("Location: ?step3&config=".$_POST['configlocation']);
        }
    }
}