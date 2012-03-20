<?php

// Setup the autoloader
$classpath = __DIR__.DIRECTORY_SEPARATOR."classes".DIRECTORY_SEPARATOR;
include $classpath."SplClassLoader.php";

$autoload = new SplClassLoader(null, $classpath);
$autoload->register();
