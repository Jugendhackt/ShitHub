<?php
/**
 * Created by anghenfil.
 * Description: Form for install script.
 * Date: 18.02.18
 * Time: 11:54
 *
 * Last change by: anghenfil
 */
if(!defined(SECURITY)){
    die();
}
$mysqlform = "<form action=\"#\" method=\"post\">
    <p>Mysql Host and Port</p>
    <input type=\"text\">
    <input type=\"text\">
    <p>Mysql User</p>
    <input type=\"text\">
    <p>Mysql Passwort</p>
    <input type=\"text\">
    <p>Mysql Database</p>
    <input type=\"text\">
    <button type=\"submit\" name=\"check_mysql\">Check MySQL</button>
</form>";

if(!isset($_POST['check_mysql'])){
    print($mysqlform);
}else{

}
?>

</body>
</html>