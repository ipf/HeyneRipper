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
use Ipf\HeyneRipper\Indexer\IndexerFactory;
use Ipf\HeyneRipper\Logger\Log;

/**
 * Description
 */
class HtmlRipper extends Ripper {

	const BASE_URL = 'http://134.76.21.92:8080/exist/rest/db/archaeo18/queries/getText.xq?mode=raw&format=xhtml&doc=###DOC###&page=###PAGE###';

	const TARGET_SCHEME = 'Data/docs/###DOC###/###PAGE###.html';

	/**
	 * @return void
	 */
	public function main() {
		foreach ($this->getDocuments() as $documentTitle => $numberOfPages) {
			echo "\n" . $documentTitle . "\n";
			$currentDocumentUrl = str_replace('###DOC###', $documentTitle, self::BASE_URL);
			$targetDirectory = str_replace('###DOC###', $documentTitle, self::TARGET_SCHEME);
			$this->createDirectory($targetDirectory);

			for ($i = 0; $i <= $numberOfPages; $i++) {
				$currentUrl = str_replace('###PAGE###', $i, $currentDocumentUrl);
				$targetFile = str_replace('###PAGE###', $i, $targetDirectory);

				if (file_exists($targetFile)) {
					Log::addInfo('Document ' . $documentTitle . ' with page ' . $i . ' already exists');
				} else {
					try {
						$currentContent = $this->getDocumentsContent($currentUrl);
						$fp = @fopen($targetFile, 'w+');
						@fwrite($fp, $currentContent);
						@fclose($fp);
						Log::addInfo('Document ' . $documentTitle . ' added with page ' . $i);
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