<?php

// Load up the Owl bootstrap
$base = dirname(__FILE__).DIRECTORY_SEPARATOR;

// This should be in vendor/owl/bootstrap.php from your project base,
// it is just in a wierd place for the demo
include realpath($base."..").DIRECTORY_SEPARATOR."bootstrap.php";

// Now we need to setup some static view properties
\Owl\View::$template_path = $base."templates".DIRECTORY_SEPARATOR;

// Include the view classes (Hopefully your app is autoloading these!!)
include "classes".DIRECTORY_SEPARATOR."view".DIRECTORY_SEPARATOR."layout".DIRECTORY_SEPARATOR."browser.php";
include "classes".DIRECTORY_SEPARATOR."view".DIRECTORY_SEPARATOR."homepage.php";

// Setup the Views
$view = new View_Layout_Browser;
$view->content(new View_Homepage);

// And render
echo $view;