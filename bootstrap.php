<?php

$path = dirname(__FILE__).DIRECTORY_SEPARATOR;

// Setup the autoloader
include $path."classes".DIRECTORY_SEPARATOR."autoloader.php";

$autoload = new \Owl\Autoloader($path."classes");
$autoload->register();

// Setup the renderer
if ( ! class_exists("Mustache"))
{
	include $path."vendor".DIRECTORY_SEPARATOR."mustache".DIRECTORY_SEPARATOR."Mustache.php";
}

\Owl\View::$renderer = new Mustache;
