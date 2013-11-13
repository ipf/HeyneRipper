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
	 * @var int
	 */
	protected $errorCounter = 0;

	/**
	 * @var \stdClass
	 */
	protected $configuration;

	/**
	 * @var \stdClass
	 */
	protected $ripperConfiguration;

	public abstract function main();

	public function __construct() {
		$this->configuration = json_decode(file_get_contents('config.json'));
		$className = get_called_class();
		$this->ripperConfiguration = $this->configuration->ripper[0]->$className;
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
	 * @param string $content
	 * @param string $file
	 * @return void
	 */
	protected function writeContentsToFile($content, $file) {
		$fp = @fopen($file, 'w+');
		@fwrite($fp, $content);
		@fclose($fp);
	}

	/**
	 * @return void
	 */
	public function increaseCounter() {
		echo "#";
		$this->counter++;
	}

	/**
	 * @return void
	 */
	public function increaseErrorCounter() {
		echo "F";
		$this->errorCounter++;
	}

	/**
	 * @return int
	 */
	public function getErrorCounter() {
		return $this->errorCounter;
	}

	/**
	 * @return int
	 */
	public function getCounter() {
		return $this->counter;
	}

} 