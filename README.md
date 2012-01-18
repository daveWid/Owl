# Owl

Owl is a view library that uses [Mustache](https://github.com/bobthecow/mustache.php)
as the renderer. Requires PHP 5.3+.

## Setup

To setup owl you will need to clone the repository. After that is done you will
need to cd into the newly created directory and run the following command.

``` bash
git submodule update --init --recursive
```

I will soon add download packages so you won't have to play around with git if you
choose not to.

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
// Assuming $full_path is a full server path to your template directory.
\Owl\View::$template_path = $full_path;
```

## Full Bootstrap Example

Below is a full example on how to bootstrap and setup the owl class, given that
the owl library is in `vendor/owl`.

``` php
// Load up the Owl bootstrap
$base = dirname(__FILE__).DIRECTORY_SEPARATOR;
include $base."vendor".DIRECTORY_SEPARATOR."owl".DIRECTORY_SEPARATOR."bootstrap.php";

// Now we need to setup the template directory
\Owl\View::$template_path = $base."templates".DIRECTORY_SEPARATOR;
```

## Extending

At this point you are ready to start creating view classes. View classes should 
extend `\Owl\View`. If you are creating a layout (or template) type view
then you can extend `\Owl\Layout` which adds in some useful layout functionality.

From there just create Mustache templates that link with \Owl\View classes.
Make sure that the `abstract get_file()` in your extended class returns the file
name to the actual mustache template file (relative to the template directory you set).

## Demo

Take a look at the demo folder to see an example of how you can use the Owl
library as your view system.

## Hacking

Feel free to hack away and send pull requests!

---

Developed by BGSU Library ITS.