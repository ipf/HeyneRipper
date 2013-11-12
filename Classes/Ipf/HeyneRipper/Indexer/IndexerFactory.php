<?php
namespace Ipf\HeyneRipper\Indexer;

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
class IndexerFactory {

	public function __construct($type) {

		$className = 'Ipf\\HeyneRipper\\Indexer\\' . $type . 'Indexer';

		if (class_exists($className)) {
			return new $className;
		} else {
			throw new \Exception('Indexer class ' . $className . '  does not exist', 1384258467);
		}
	}

} 