<?php
namespace Ipf\HeyneRipper\Tests;

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
class HeyneRipperTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var \Ipf\HeyneRipper\HeyneRipper
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new \Ipf\HeyneRipper\HeyneRipper();
	}

	/**
	 * @test
	 * @expectedException Exception
	 */
	public function exceptionIsThrownWhenNonExistingClassNameIsCalled() {
		$this->fixture->main('Mittler');
	}
} 