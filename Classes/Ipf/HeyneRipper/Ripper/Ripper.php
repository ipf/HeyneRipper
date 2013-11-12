<?php
namespace Ipf\HeyneRipper\Ripper;

	/* * *************************************************************
	 *  Copyright notice
	 *
	 *  (c) 2013 Ingo Pfennigstorf <pfennigstorf@sub-goettingen.de>
	 *      Goettingen State Library
	 *
	 *  All rights reserved
	 * ************************************************************* */

/**
 * Description
 */
abstract class Ripper {

	protected $documents = array(
		'rom-heyne1798' => 269,
		'berlin-ms-germ-qrt-1666' => 311,
		'bern-mss-muel-507' => 631,
		'weimar-hs-2056' => 492
	);

	/**
	 * @var int
	 */
	protected $counter = 0;

	public abstract function main();

	/**
	 * @return array
	 */
	protected function getDocuments() {
		return $this->documents;
	}

	/**
	 * @param string $targetDirectory
	 * @return bool
	 */
	protected function createDirectory($targetDirectory) {
		$directoryToTest = dirname($targetDirectory);

		if (!is_dir($directoryToTest)) {
			return mkdir($directoryToTest, 0777, TRUE);
		}
	}

	/**
	 * @return void
	 */
	public function increaseCounter() {
		$this->counter++;
	}

	/**
	 * @return int
	 */
	public function getCounter() {
		return $this->counter;
	}
} 