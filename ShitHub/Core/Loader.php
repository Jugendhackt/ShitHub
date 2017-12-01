<?php

namespace ShitHub\Core;

class Loader{
	private static $logger;

	public function load(){
		Loader::$logger = new \Monolog\Logger('mainlog');

		if(ERROR_LEVEL == "DEBUG"){
			Loader::$logger->pushHandler(new \Monolog\Handler\StreamHandler(__DIR__.'/../../log', \Monolog\Logger::DEBUG));
		}else if(ERROR_LEVEL == "INFO"){
			Loader::$logger->pushHandler(new \Monolog\Handler\StreamHandler(__DIR__.'/../../log', \Monolog\Logger::INFO));
		}else if(ERROR_LEVEL == "NOTICE"){
			Loader::$logger->pushHandler(new \Monolog\Handler\StreamHandler(__DIR__.'/../../log', \Monolog\Logger::NOTICE));
		}else if(ERROR_LEVEL == "WARNING"){
			Loader::$logger->pushHandler(new \Monolog\Handler\StreamHandler(__DIR__.'/../../log', \Monolog\Logger::WARNING));
		}else if(ERROR_LEVEL == "ERROR"){
			Loader::$logger->pushHandler(new \Monolog\Handler\StreamHandler(__DIR__.'/../../log', \Monolog\Logger::ERROR));
		}else if(ERROR_LEVEL == "CRITICAL"){
			Loader::$logger->pushHandler(new \Monolog\Handler\StreamHandler(__DIR__.'/../../log', \Monolog\Logger::CRITICAL));
		}else if(ERROR_LEVEL == "ALERT"){
			Loader::$logger->pushHandler(new \Monolog\Handler\StreamHandler(__DIR__.'/../../log', \Monolog\Logger::ALERT));
		}else if(ERROR_LEVEL == "EMERGENCY"){
			Loader::$logger->pushHandler(new \Monolog\Handler\StreamHandler(__DIR__.'/../../log', \Monolog\Logger::EMERGENCY));
		}

		//\ShitHub\Core\Loader::getLogger()->debug('Log started.');
		$constructor = new \ShitHub\Core\SiteConstructor();

		$constructor->construct();
	}

	public static function getLogger(){
		return Loader::$logger;
	}
}