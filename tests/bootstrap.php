<?php

// Setup the autoloader
include dirname(__DIR__).DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."autoload.php";

// Load up clases needed for the tests
foreach (glob("tests/classes/*.php") as $filename)
{
    include_once $filename;
}