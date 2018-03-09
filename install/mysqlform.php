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
    <input type=\"text\" value=\"localhost\" name='host'>
    <input type=\"text\" value=\"3306\" name='port'>
    <p>Mysql User</p>
    <input type=\"text\" name='user'>
    <p>Mysql Passwort</p>
    <input type=\"password\" name='password'>
    <p>Mysql Database</p>
    <input type=\"text\" name='database'>
    <button type=\"submit\" name=\"check_mysql\">Check MySQL</button>
</form>";
$form2 = '<form action="?step3"></form>';

if(!isset($_POST['check_mysql'])){
    print($mysqlform);
}else{
    if(empty($_POST['host']) || empty($_POST['port']) || empty($_POST['database']) || empty($_POST['user']) || empty($_POST['password'])){
        print($mysqlform);
    }else {
        $error = false;
        try {
            $dbh = new PDO('mysql:host=' . $_POST['host'] . ';port=' . $_POST['port'] . ';dbname=' . $_POST['database'], $_POST['user'], $_POST['password']);
            $tables = "CREATE TABLE users
(
  id        INT AUTO_INCREMENT
    PRIMARY KEY,
  uname     VARCHAR(45)  NULL,
  pwhash    VARCHAR(255) NULL,
  email     VARCHAR(255) NOT NULL,
  lastlogin VARCHAR(10)  NULL,
  pwchange  VARCHAR(10)  NULL
)
  ENGINE = InnoDB;
  CREATE TABLE snippets
(
  id          INT AUTO_INCREMENT
    PRIMARY KEY,
  title       VARCHAR(150) NOT NULL,
  description VARCHAR(250) NULL,
  language    VARCHAR(20)  NOT NULL,
  tags        VARCHAR(250) NULL,
  author_id   INT          NULL,
  author_name VARCHAR(45)  NULL,
  status      TINYINT      NULL,
  date        VARCHAR(10)  NULL
)
  ENGINE = InnoDB;
  CREATE TABLE reviews
(
  id                  INT AUTO_INCREMENT
    PRIMARY KEY,
  snippet_id          INT   NOT NULL,
  rating_security     FLOAT NULL,
  rating_cleanliness  FLOAT NULL,
  rating_total        FLOAT NULL,
  security_comment    TEXT  NULL,
  cleanliness_comment TEXT  NULL,
  total_comment       TEXT  NOT NULL,
  author_id           INT   NOT NULL
)
  ENGINE = InnoDB;";
$dbh->exec($tables);
        }catch(PDOException $e){
            $error = true;
        }

        if($error){
            print("<b style='color: red'>MySQL Connection not succesfull!</b>");
            print($mysqlform);
        }else{
            print("<b style='color: green'>MySQL Connection succesfull!</b>");

            $configappend = "\nDB_HOST = \"".$_POST['host']."\"\nDB_PORT = \"".$_POST['port']."\"\nDB_NAME = \"".$_POST['database']."\"\nDB_UNAME = \"".$_POST['user']."\"\nDB_PW = \"".$_POST['password']."\"\n";

            $file = fopen($_GET['config'], "a") or die ("Error writing to config file.");
            fwrite($file, $configappend);
            fclose($file);

            print("<b style='color: green'>ShitHub installed succesfull! Please REMOVE INSTALL FOLDER AND DON'T START THE INSTALLATION AGAIN!</b>");
        }
    }
}
?>

</body>
</html>