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
			$currentDocumentUrl = str_replace('###DOC###', $document->title, $this->configuration->baseUrl);
			$targetDirectory = str_replace('###DOC###', $document->title, $this->configuration->targetScheme);
			$this->createDirectory($targetDirectory);

			for ($i = 0; $i <= $document->pages; $i++) {
				$currentUrl = str_replace('###PAGE###', $i, $currentDocumentUrl);
				$targetFile = str_replace('###PAGE###', $i, $targetDirectory);

				if (file_exists($targetFile)) {
					Log::addInfo('Document ' . $document->title . ' with page ' . $i . ' already exists');
				} else {
					try {
						$currentContent = $this->getDocumentsContent($currentUrl);
						$fp = @fopen($targetFile, 'w+');
						@fwrite($fp, $currentContent);
						@fclose($fp);
						Log::addInfo('Document ' . $document->title . ' added with page ' . $i);
						$this->increaseCounter();
						echo "#";
					} catch (\Exception $e) {
						Log::addError($e->getMessage());
						echo "F";
					}
				}
			}
		}
		return $this->getCounter();
	}

	protected function getDocumentsContent($url) {
		$content = @file_get_contents($url);
		if (strlen($content) === 0) {
			Log::addError($url . ' does not contain any content');
			throw new \Exception($url . ' does not contain any content');
		} else {
			return $content;
		}
	}
} 