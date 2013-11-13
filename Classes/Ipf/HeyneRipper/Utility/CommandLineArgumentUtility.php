<?php
namespace Ipf\HeyneRipper\Utility;

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
class CommandLineArgumentUtility {

	/**
	 * Allowed command line arguments
	 *
	 * @var array
	 */
	protected static $allowedArguments = array(
		'clean' => ''
	);

	/**
	 * @param array $arguments
	 */
	public static function parseCommandLineArguments($arguments) {
		// check if an allowed argument is provided in cli mode and execute the corresponding function
		if (array_key_exists(1, $arguments)
				&& array_key_exists($arguments[1], self::$allowedArguments)) {
			$argumentName = filter_var($arguments[1], FILTER_SANITIZE_STRING);
			$methodName = $argumentName . 'Command';

			// does the method that is about to be called exist?
			if (is_callable('self::' . $methodName)) {
				$message = call_user_func('self::' . $methodName);
				\Ipf\HeyneRipper\Logger\Log::addInfo($message);
				die($message);
			}
		} else {
			echo "The provided command is not registered.\n";
			echo "Please use one of the following:\n";
			foreach (array_keys(self::$allowedArguments) as $allowedArgument) {
				echo ' * ' . $allowedArgument . "\n";
			}
			die();
		}
	}

	/**
	 * @return string
	 */
	protected static function cleanCommand() {
		\Ipf\HeyneRipper\Utility\CleanUpUtility::cleanDirectories();
		$cleanUpMessage = 'Directories cleared';
		return $cleanUpMessage . "\n";
	}

}