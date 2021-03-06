<?php
require_once('Classes/Contrib/autoload.php');

\Ipf\HeyneRipper\Utility\TimeUtility::start();

echo file_get_contents('Resources/Public/Ascii/Logo.txt');

$heyneRipper = new Ipf\HeyneRipper\HeyneRipper();

if (count($argv) > 1) {
	\Ipf\HeyneRipper\Utility\CommandLineArgumentUtility::parseCommandLineArguments($argv);
}

$configuredRipper = \Ipf\HeyneRipper\Utility\ConfigurationUtility::getConfiguration()->ripper;

$numberOfDocuments = 0;

try {
	foreach ($configuredRipper as $className => $ripperConfiguration) {
		echo "\n" . $className . "\n";
		$numberOfDocuments += $heyneRipper->main($className);
	}
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