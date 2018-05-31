<?php


use ShitHub\CodeViewer\CodeViewer;

class CodeViewerTest extends PHPUnit_Framework_TestCase {

  public function testAdding(){
        define("SECURITY", "TRUE");
        define("CONFIG_PATH", "/var/www/");
        define("CONFIG_NAME", "config-old.env");

        $dotenv = new Dotenv\Dotenv(CONFIG_PATH, CONFIG_NAME);
        $dotenv->load();

        $loader = new \ShitHub\Core\Loader();
        $loader->load();

        $cw = new CodeViewer(1);
        $cw->show();
  }

}