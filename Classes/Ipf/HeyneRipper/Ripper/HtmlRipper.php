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

/**
 * Description 
 */
class HtmlRipper extends Ripper {

	const BASE_URL = 'http://134.76.21.92:8080/exist/rest/db/archaeo18/queries/getText.xq?mode=raw&format=xhtml&doc=###DOC###&page=###PAGE###';

	const TARGET_SCHEME = 'docs/###DOC###/###PAGE###.html';

	public function main() {
		foreach ($this->getDocuments() as $documentTitle => $numberOfPages) {

			$currentDocumentUrl = str_replace('###DOC###', $documentTitle, self::BASE_URL);
			$targetDirectory = str_replace('###DOC###', $documentTitle, self::TARGET_SCHEME);
			$this->createDirectory($targetDirectory);

			for ($i = 0; $i <= $numberOfPages; $i++) {
				$currentUrl = str_replace('###PAGE###', $i, $currentDocumentUrl);
				$targetFile = str_replace('###PAGE###', $i, $targetDirectory);

				if (file_exists($targetFile)) {
					echo 'Dokument ' . $documentTitle . ' existiert bereits mit Seite ' . $i . "\n";
				} else {
					$currentContent = file_get_contents($currentUrl);
					$fp = @fopen($targetFile, 'w+');
					@fwrite($fp, $currentContent);
					@fclose($fp);
					echo 'Dokument ' . $documentTitle . ' hinzugefuegt mit Seite ' . $i . "\n";
				}
			}
		}
	}
} 