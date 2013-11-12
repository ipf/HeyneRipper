<?php
namespace Ipf\HeyneRipper\Logger;

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Ingo Pfennigstorf <pfennigstorf@sub-goettingen.de>
 *      Goettingen State Library
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * Description
 */
class Log {

	const LOGFILE = 'Data/Logs/HeyneRipper.log';

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

		$loggerDirectory = dirname(self::LOGFILE);

		if (!is_dir($loggerDirectory)) {
			mkdir($loggerDirectory, 0777, TRUE);
		}
		return self::LOGFILE;
	}
}