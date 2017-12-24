<?php
namespace ShitHub\Core;

if(!defined(SECURITY)){
	die("Direct invocation isn't allowed.");
}

class Loader{
	private static $logger;

	public function load(){
		Loader::$logger = new \Monolog\Logger('mainlog');

		if($_ENV['ERROR_LEVEL'] == "DEBUG"){
			Loader::$logger->pushHandler(new \Monolog\Handler\StreamHandler(__DIR__.'/../../log', \Monolog\Logger::DEBUG));
		}else if($_ENV['ERROR_LEVEL'] == "INFO"){
			Loader::$logger->pushHandler(new \Monolog\Handler\StreamHandler(__DIR__.'/../../log', \Monolog\Logger::INFO));
		}else if($_ENV['ERROR_LEVEL'] == "NOTICE"){
			Loader::$logger->pushHandler(new \Monolog\Handler\StreamHandler(__DIR__.'/../../log', \Monolog\Logger::NOTICE));
		}else if($_ENV['ERROR_LEVEL'] == "WARNING"){
			Loader::$logger->pushHandler(new \Monolog\Handler\StreamHandler(__DIR__.'/../../log', \Monolog\Logger::WARNING));
		}else if($_ENV['ERROR_LEVEL'] == "ERROR"){
			Loader::$logger->pushHandler(new \Monolog\Handler\StreamHandler(__DIR__.'/../../log', \Monolog\Logger::ERROR));
		}else if($_ENV['ERROR_LEVEL'] == "CRITICAL"){
			Loader::$logger->pushHandler(new \Monolog\Handler\StreamHandler(__DIR__.'/../../log', \Monolog\Logger::CRITICAL));
		}else if($_ENV['ERROR_LEVEL'] == "ALERT"){
			Loader::$logger->pushHandler(new \Monolog\Handler\StreamHandler(__DIR__.'/../../log', \Monolog\Logger::ALERT));
		}else if($_ENV['ERROR_LEVEL'] == "EMERGENCY"){
			Loader::$logger->pushHandler(new \Monolog\Handler\StreamHandler(__DIR__.'/../../log', \Monolog\Logger::EMERGENCY));
		}

		\Monolog\ErrorHandler::register(Loader::$logger);
		error_reporting(0);

		$constructor = new \ShitHub\Core\SiteConstructor();

		$constructor->construct();
	}

	public static function getLogger(){
		return Loader::$logger;
	}
}