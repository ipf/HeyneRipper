<?php
require_once('Classes/Contrib/autoload.php');

$heyneRipper = new Ipf\HeyneRipper\HeyneRipper();

try {
	echo $heyneRipper->main('Html') + ' Documents added';
} catch (\Exception $e) {
	echo $e->getMessage();
}