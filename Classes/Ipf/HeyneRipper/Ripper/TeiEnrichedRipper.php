<?php
namespace Ipf\HeyneRipper\Ripper;

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Ingo Pfennigstorf <pfennigstorf@sub-goettingen.de>
 *      Goettingen State Library
 *
 *  All rights reserved
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

use Ipf\HeyneRipper\Logger\Log;

/**
 * Get TEI Documents
 */
class TeiEnrichedRipper extends Ripper {

	public function main() {
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
} 