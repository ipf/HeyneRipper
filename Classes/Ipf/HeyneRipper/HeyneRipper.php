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
			return $ripperClass->main();
		} else {
			$message = 'Class ' . $classBuilder . ' does not exist';
			\Ipf\HeyneRipper\Logger\Log::addWarning($message);
			throw new \Exception($message, 1384248127);
		}
	}
}