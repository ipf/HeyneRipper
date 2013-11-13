<?php
namespace Ipf\HeyneRipper\Utility;

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Ingo Pfennigstorf <pfennigstorf@sub-goettingen.de>
 *      Goettingen State Library
 *  
 *  All rights reserved
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

/**
 * Description 
 */
class CleanUpUtility {

	/**
	 * Clean up temporay data such as logs and downloaded files from Data directory
	 *
	 * @return void
	 */
	static public function cleanDirectories() {
		$dir = 'Data';
		if (is_dir($dir)) {
			$iterator = new \RecursiveDirectoryIterator($dir);
			$files = new \RecursiveIteratorIterator($iterator, \RecursiveIteratorIterator::CHILD_FIRST);
			foreach ($files as $file) {
				if ($file->getFilename() === '.' || $file->getFilename() === '..') {
					continue;
				}
				if ($file->isDir()) {
					rmdir($file->getRealPath());
				} else {
					unlink($file->getRealPath());
				}
			}
			rmdir($dir);
		}
	}

} 