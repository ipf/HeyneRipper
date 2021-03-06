<?php
namespace Ipf\HeyneRipper\Logger;

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Ingo Pfennigstorf <pfennigstorf@sub-goettingen.de>
 *      Goettingen State Library
 *  
 *  All rights reserved
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
		$log = self::getLogger('warning');
		$log->addWarning($warning);
	}

	static public function addInfo($info) {
		$log = self::getLogger('info');
		$log->addInfo($info);
	}

	static public function addError($error) {
		$log = self::getLogger('error');
		$log->addError($error);
	}

	/**
	 * @return Logger
	 */
	protected function getLogger($type) {
		/** @var \Monolog\Logger $log */
		$log = new Logger('HeyneLogger');
		$logLevels = Logger::getLevels();
		// get integer from constant
		$typeConstant = $logLevels[strtoupper($type)];
		$log->pushHandler(new StreamHandler(self::getLogFile($type), $typeConstant));
		return $log;
	}

	/**
	 * @return string
	 */
	protected function getLogFile($type = 'warning') {

		$loggerConfiguration = ConfigurationUtility::getConfiguration()->logger->$type->logFile;
		$loggerDirectory = dirname($loggerConfiguration);

		if (!is_dir($loggerDirectory)) {
			mkdir($loggerDirectory, 0777, TRUE);
		}
		return $loggerConfiguration;
	}
}