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

/**
 * Get TEI Documents
 */
class TeiRipper extends Ripper {

	public function main() {
		parent::getSingleDocument();
	}
} 