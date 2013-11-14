<?php
namespace Ipf\HeyneRipper;

/**
 * Ripping all Documents for Heyne Digital
 */
class HeyneRipper {

	/**
	 * @throws \Exception
	 * @param string $className
	 * @return int
	 */
	public function main($className) {

		if (class_exists($className)) {
			$ripperClass = new $className;
			return $ripperClass->main();
		} else {
			throw new \Exception('Class ' . $className . ' does not exist', 1384248127);
		}
	}
}