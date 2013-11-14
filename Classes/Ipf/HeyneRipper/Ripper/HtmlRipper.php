<?php
namespace Ipf\HeyneRipper\Ripper;

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Ingo Pfennigstorf <pfennigstorf@sub-goettingen.de>
 *      Goettingen State Library
 *  
 *  All rights reserved
 * ************************************************************* */

/**
 * Rips pages in HTML format
 */
class HtmlRipper extends Ripper {

	/**
	 * @return void
	 */
	public function main() {
		parent::getDocumentWithPages();
	}

} 