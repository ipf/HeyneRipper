<?php
namespace Ipf\HeyneRipper\Ripper;

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Ingo Pfennigstorf <pfennigstorf@sub-goettingen.de>
 *      Goettingen State Library
 *  
 *  All rights reserved
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */
use Ipf\HeyneRipper\Logger\Log;

/**
 * Description
 */
class HtmlRipper extends Ripper {

	/**
	 * @return void
	 */
	public function main() {
		foreach ($this->configuration->documents as $document) {
			echo "\n" . $document->title . "\n";
			$currentDocumentUrl = str_replace('###DOC###', $document->title, $this->ripperConfiguration->baseUrl);
			$targetDirectory = str_replace('###DOC###', $document->title, $this->ripperConfiguration->targetScheme);
			$this->createDirectory($targetDirectory);

			for ($i = 0; $i <= $document->pages; $i++) {
				$currentUrl = str_replace('###PAGE###', $i, $currentDocumentUrl);
				$targetFile = str_replace('###PAGE###', $i, $targetDirectory);

				if (!file_exists($targetFile)) {
					try {
						$currentContent = $this->getDocumentsContent($currentUrl);
						$this->writeContentsToFile($currentContent, $targetFile);
						$this->increaseCounter();
					} catch (\Exception $e) {
						Log::addError($e->getMessage());
						$this->increaseErrorCounter();
					}
				}
			}
		}
		return $this->getCounter();
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
} 