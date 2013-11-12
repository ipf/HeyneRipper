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

	/**
	 * @var int
	 */
	protected $counter = 0;

	/**
	 * @var \stdClass
	 */
	protected $configuration;

	public abstract function main();

	public function __construct() {
		$this->configuration = json_decode(file_get_contents('config.json'));
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