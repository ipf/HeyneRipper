<?php
namespace Ipf\HeyneRipper\Indexer;

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
class SolrIndexer implements IndexerInterface{

	/**
	 * @var \Solarium\Client
	 */
	protected $indexerInstance;

	/**
	 * @param string $title
	 * @param int $pageNumber
	 * @param string $content
	 * @return bool
	 */
	public function commitToIndex($title, $pageNumber, $content) {
		return FALSE;
	}

	/**
	 * @return void
	 */
	function getIndexerInstance() {
		$this->indexerInstance = new \Solarium\Client();
	}
}