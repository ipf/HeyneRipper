<?php
namespace Ipf\HeyneRipper;

/**
 * Ripping all Documents for Heyne Digital
 */
class HeyneRipper {

	/**
	 * @param string $type
	 * @return void
	 */
	public function main($type) {

		$classBuilder = 'Ipf\\HeyneRipper\\Ripper\\' .$type . 'Ripper';

		if (class_exists($classBuilder)) {
			$ripperClass = new $classBuilder;
			$ripperClass->main();
		} else {
			throw new \Exception('Class ' . $classBuilder . ' does not exist', 1384248127);
		}
	}
}