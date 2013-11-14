<?php
require_once('Classes/Contrib/autoload.php');

\Ipf\HeyneRipper\Utility\TimeUtility::start();

$heyneRipper = new Ipf\HeyneRipper\HeyneRipper();

if (count($argv) > 1) {
	\Ipf\HeyneRipper\Utility\CommandLineArgumentUtility::parseCommandLineArguments($argv);
}

try {
	$numberOfDocuments = $heyneRipper->main('Html');
	$numberOfDocuments += $heyneRipper->main('StructureHtml');
	$message = $numberOfDocuments . ' Documents added';
	\Ipf\HeyneRipper\Logger\Log::addInfo($message);
	echo "\n" . $message . "\n";
} catch (\Exception $e) {
	\Ipf\HeyneRipper\Logger\Log::addError($e->getMessage());
	echo $e->getMessage();
}

\Ipf\HeyneRipper\Utility\TimeUtility::stop();

echo "\n" . \Ipf\HeyneRipper\Utility\TimeUtility::executionTime() . ' seconds needed for execution ' . "\n";
echo 'Average ' . \Ipf\HeyneRipper\Utility\TimeUtility::timePerDocument($numberOfDocuments) . ' seconds per document ' . "\n";