<?php
namespace Ipf\HeyneRipper\Logger;

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Ingo Pfennigstorf <pfennigstorf@sub-goettingen.de>
 *      Goettingen State Library
 *  
 *  All rights reserved
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

use Ipf\HeyneRipper\Utility\ConfigurationUtility;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * Description
 */
class Log {

	/**
	 * @param String $warning
	 * @return void
	 */
	static public function addWarning($warning) {
		$log = self::getLogger();
		$log->addWarning($warning, array('Class' => get_called_class()));
	}

	static public function addInfo($info) {
		$log = self::getLogger();
		$log->addInfo($info);
	}

	static public function addError($error) {
		$log = self::getLogger();
		$log->addError($error);
	}

	/**
	 * @return Logger
	 */
	protected function getLogger() {
		/** @var \Monolog\Logger $log */
		$log = new Logger('HeyneLogger');
		$loggerDirectory = self::getLoggerDirectory();
		$log->pushHandler(new StreamHandler($loggerDirectory, Logger::WARNING));
		$log->pushHandler(new StreamHandler($loggerDirectory, Logger::INFO));
		$log->pushHandler(new StreamHandler($loggerDirectory, Logger::ERROR));
		return $log;
	}

	/**
	 * @return string
	 */
	protected function getLoggerDirectory() {

		$loggerConfiguration = ConfigurationUtility::getConfiguration()->logfile;
		$loggerDirectory = dirname($loggerConfiguration);

		if (!is_dir($loggerDirectory)) {
			mkdir($loggerDirectory, 0777, TRUE);
		}
		return $loggerConfiguration;
	}
}