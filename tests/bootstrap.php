<?php

// Setup the autoloader
include __DIR__.DIRECTORY_SEPARATOR."classes".DIRECTORY_SEPARATOR."SplClassLoader.php";

$parts = array(__DIR__, "..", "classes");
$path = realpath(implode(DIRECTORY_SEPARATOR, $parts)).DIRECTORY_SEPARATOR;

$autoload = new SplClassLoader(null, $path);
$autoload->register();

unset($parts, $path);

// Load up clases needed for the tests
foreach (glob("tests/classes/*.php") as $filename)
{
    include_once $filename;
}