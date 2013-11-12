<?php
namespace Ipf\HeyneRipper\Tests\Ripper;

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
class HtmlRipperTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var \Ipf\HeyneRipper\Ripper\HtmlRipper
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = $this->getMock('Ipf\\HeyneRipper\\Ripper\\HtmlRipper', array('main'));
	}

}