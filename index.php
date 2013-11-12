<?php
require_once('Classes/Contrib/autoload.php');

$heyneRipper = new Ipf\HeyneRipper\HeyneRipper();

try {
	$heyneRipper->main('Html');
} catch (\Exception $e) {
	echo $e->getMessage();
}