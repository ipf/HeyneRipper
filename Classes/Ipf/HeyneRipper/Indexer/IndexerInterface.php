<?php

namespace Ipf\HeyneRipper\Indexer;


interface IndexerInterface {

	function commitToIndex($title, $pageNumner, $content);

	function getIndexerInstance();
}