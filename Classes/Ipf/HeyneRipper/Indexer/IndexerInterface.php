<?php
/**
 * Created by PhpStorm.
 * User: ingop
 * Date: 12.11.13
 * Time: 09:29
 */

namespace Ipf\HeyneRipper\Indexer;


interface IndexerInterface {

	function commitToIndex();

	function getIndexerInstance();
}