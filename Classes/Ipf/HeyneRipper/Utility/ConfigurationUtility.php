<?php
namespace Ipf\HeyneRipper\Utility;

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
class ConfigurationUtility {

	/**
	 * @return mixed
	 */
	public static function getConfiguration() {
		$configuration = json_decode(file_get_contents('config.json'));
		return $configuration;
	}

} 