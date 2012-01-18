# Owl

Owl is a view library that uses Mustache as the renderer. Requires PHP 5.3+.

## Setup

To setup owl you will need to clone the repository. After that is done you will
need to cd into the newly created directory and run the following command.

``` bash
git submodule update --init --recursive
```

## Including

Owl has autoloading built-in. To activate it you will need to include the bootstrap.php
file

``` php
include "owl/bootstrap.php";
```

## Using

Before you can start using the Owl library you will need to set the full server
path to your template directory.

``` php
\Owl\View::$template_path = $full_path;
```

## Full Bootstrap Example

Below is a full example on how to bootstrap and setup the owl class, given that
the owl library is in `vendor/owl`.

``` php
// Load up the Owl bootstrap
$base = dirname(__FILE__).DIRECTORY_SEPARATOR;
include $base."vendor".DIRECTORY_SEPARATOR."owl".DIRECTORY_SEPARATOR."bootstrap.php";

// Now we need to setup some static view properties
\Owl\View::$template_path = $base."templates".DIRECTORY_SEPARATOR;
```

## Extending

At this point you are ready to start creating view files. For normal view files 
you should extend `\Owl\View`. If you are creating a layout (or template) type view
then you can extend `\Owl\Layout` which adds in some useful layout functions.

From there just create Mustache templates that link with \Owl\View classes.

## Demo

Take a look at the demo folder to see an example of how you can use the Owl
library as your view system.

## Extending

Feel free to hack away and send pull requests!

---

Developed by BGSU Library ITS.