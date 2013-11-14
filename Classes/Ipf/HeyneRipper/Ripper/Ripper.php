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
		$this->ripperConfiguration = $this->configuration->ripper->$className;
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
	 * Retrieves single documents without pages
	 *
	 * @return int
	 */
	public function getSingleDocument() {
		foreach ($this->configuration->documents as $document) {
			echo "\n" . $document->title . "\n";
			$currentDocumentUrl = str_replace('###DOC###', $document->title, $this->ripperConfiguration->baseUrl);
			$targetDirectory = str_replace('###DOC###', $document->title, $this->ripperConfiguration->targetScheme);
			$this->createDirectory($targetDirectory);

			if (!file_exists($targetDirectory)) {
				try {
					$currentContent = $this->getDocumentsContent($currentDocumentUrl);
					$this->writeContentsToFile($currentContent, $targetDirectory);
					$this->increaseCounter();
				} catch (\Exception $e) {
					Log::addError($e->getMessage());
					$this->increaseErrorCounter();
				}
			}

		}
		return $this->getCounter();
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
	 * @param $url
	 * @return string
	 * @throws \Exception
	 */
	protected function getDocumentsContent($url) {
		$content = @file_get_contents($url);
		if (strlen($content) === 0) {
			throw new \Exception($url . ' does not contain any content');
		} else {
			return $content;
		}
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