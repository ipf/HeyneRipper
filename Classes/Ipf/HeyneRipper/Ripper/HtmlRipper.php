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

} 