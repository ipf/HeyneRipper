<?php
namespace Ipf\HeyneRipper\Utility;

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Ingo Pfennigstorf <pfennigstorf@sub-goettingen.de>
 *      Goettingen State Library
 *  
 *  All rights reserved
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

/**
 * Description 
 */
class TimeUtility {

	/**
	 * @var int
	 */
	protected static $startTime;

	/**
	 * @var int
	 */
	protected static $stopTime;

	/**
	 * @return void
	 */
	static public function start() {
		self::$startTime = time();
	}

	/**
	 * @return int
	 */
	static public function stop() {
		self::$stopTime = time();
	}

	/**
	 * @return int
	 */
	static public function executionTime() {
		return self::$stopTime - self::$startTime;
	}

	/**
	 * @param int $numberOfDocuments
	 * @return float|int
	 */
	static public function timePerDocument($numberOfDocuments) {

		if ($numberOfDocuments !== 0) {
			return self::executionTime() / $numberOfDocuments;
		} else {
			return 0;
		}
	}

} 