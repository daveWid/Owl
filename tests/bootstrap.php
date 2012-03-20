<?php

// Include the library bootstrap
include realpath(__DIR__.DIRECTORY_SEPARATOR."..").DIRECTORY_SEPARATOR."bootstrap.php";


// Load up clases needed for the tests
foreach (glob("tests/classes/*.php") as $filename)
{
    include $filename;
} 

