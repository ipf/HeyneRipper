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
 * Get the structure of a document
 */
class StructureHtmlRipper extends Ripper {

	public function main() {
		parent::getSingleDocument();
	}

} 