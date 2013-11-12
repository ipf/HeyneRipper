<?php
require_once('Classes/Contrib/autoload.php');

$startTime = time();

$heyneRipper = new Ipf\HeyneRipper\HeyneRipper();

function cleanDirectories() {
	$dir = 'Data';
	$iterator = new RecursiveDirectoryIterator($dir);
	$files = new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::CHILD_FIRST);
	foreach ($files as $file) {
		if ($file->getFilename() === '.' || $file->getFilename() === '..') {
			continue;
		}
		if ($file->isDir()) {
			rmdir($file->getRealPath());
		} else {
			unlink($file->getRealPath());
		}
	}
	rmdir($dir);
}

if (array_key_exists(1, $argv) && $argv[1] === 'clean') {
	cleanDirectories();
	die('Directories cleared');
}

try {
	$numberOfDocuments = $heyneRipper->main('Html');
	echo "\n" . $numberOfDocuments . ' Documents added' . "\n";
} catch (\Exception $e) {
	echo $e->getMessage();
}

$endTime = time();

$timeTaken = $endTime - $startTime;

$timePerDocument = 0;

if ($numberOfDocuments !== 0) {
	$timePerDocument = $timeTaken / $numberOfDocuments;
}

echo "\n" . $timeTaken . ' seconds needed for execution ' . "\n";
echo $timePerDocument . ' seconds per document ' . "\n";