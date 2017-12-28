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
			Loader::$logger->pushHandler(new \Monolog\Handler\StreamHandler($_ENV['LOG_LOCATION'], \Monolog\Logger::DEBUG));
		}else if($_ENV['ERROR_LEVEL'] == "INFO"){
			Loader::$logger->pushHandler(new \Monolog\Handler\StreamHandler($_ENV['LOG_LOCATION'], \Monolog\Logger::INFO));
		}else if($_ENV['ERROR_LEVEL'] == "NOTICE"){
			Loader::$logger->pushHandler(new \Monolog\Handler\StreamHandler($_ENV['LOG_LOCATION'], \Monolog\Logger::NOTICE));
		}else if($_ENV['ERROR_LEVEL'] == "WARNING"){
			Loader::$logger->pushHandler(new \Monolog\Handler\StreamHandler($_ENV['LOG_LOCATION'], \Monolog\Logger::WARNING));
		}else if($_ENV['ERROR_LEVEL'] == "ERROR"){
			Loader::$logger->pushHandler(new \Monolog\Handler\StreamHandler($_ENV['LOG_LOCATION'], \Monolog\Logger::ERROR));
		}else if($_ENV['ERROR_LEVEL'] == "CRITICAL"){
			Loader::$logger->pushHandler(new \Monolog\Handler\StreamHandler($_ENV['LOG_LOCATION'], \Monolog\Logger::CRITICAL));
		}else if($_ENV['ERROR_LEVEL'] == "ALERT"){
			Loader::$logger->pushHandler(new \Monolog\Handler\StreamHandler($_ENV['LOG_LOCATION'], \Monolog\Logger::ALERT));
		}else if($_ENV['ERROR_LEVEL'] == "EMERGENCY"){
			Loader::$logger->pushHandler(new \Monolog\Handler\StreamHandler($_ENV['LOG_LOCATION'], \Monolog\Logger::EMERGENCY));
		}

		\Monolog\ErrorHandler::register(Loader::$logger);

		$constructor = new \ShitHub\Core\SiteConstructor();

		$constructor->construct();
	}

	public static function getLogger(){
		return Loader::$logger;
	}
}