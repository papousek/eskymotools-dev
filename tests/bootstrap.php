<?php
namespace eskymo;
use eskymo\loaders;
/**
 * Check PHPUnit version (3.5.0 or higher required).
 * New versions load PHPUnit framework automatically.
 */
if (!class_exists('PHPUnit_Framework_TestCase') /*|| (float) PHPUnit_Runner_Version::id() < 3.5*/) {
	if (@include_once 'PHPUnit/Framework.php') {
		die(sprintf("\nPHPUnit 3.5.0 or higher required, you have %s.\n", PHPUnit_Runner_Version::id()));
	} else {
		die("\nPHPUnit 3.5.0 or higher required, none installed.\n");
	}
}

require_once __DIR__ . '/../lib/nette/Nette/loader.php';

$loader = new \Nette\Loaders\RobotLoader();
$loader->addDirectory(__DIR__ . '/../eskymo/');
$loader->addDirectory(__DIR__);
$loader->register();