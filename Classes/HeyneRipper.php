<?php
namespace Ipf\HeyneRipper;

/**
 * Ripping all Documents for Heyne Digital
 */
class HeyneRipper {

	/**
	 * @var array
	 * @todo determine everything dynamically
	 */
	protected $documents = array(
		'rom-heyne1798' => 269,
		'berlin-ms-germ-qrt-1666' => 311,
		'bern-mss-muel-507' => 631,
		'weimar-hs-2056' => 492
	);

	const BASE_URL = 'http://134.76.21.92:8080/exist/rest/db/archaeo18/queries/getText.xq?mode=raw&format=xhtml&doc=###DOC###&page=###PAGE###';

	const TARGET_SCHEME = 'docs/###DOC###/###PAGE###.html';

	/**
	 * @return void
	 */
	public function main() {
		foreach ($this->documents as $documentTitle => $numberOfPages) {

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

	/**
	 * @param $targetDirectory
	 */
	protected function createDirectory($targetDirectory) {
		$directoryToTest = dirname($targetDirectory);
		mkdir($directoryToTest, 0777, TRUE);
	}

}