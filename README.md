# Owl

Owl is a view library that can interface with different tmeplate rendering engines.
Owl uses [Mustache](https://github.com/bobthecow/mustache.php) as the default
rendering engine. Requires PHP 5.3+.

## Downloading

Visit the [downloads](https://github.com/daveWid/Owl/downloads) page and click
on the latest version to grab the files.

Once you have the files downloaded and unzipped, move the classes over to your
application.

## Autoloading

Owl fully supports [PSR-0](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md)
autoloading.

## Setup

The Owl library strives for flexibility in rendering engines and finding files.
Unfortunately this flexibility adds a few more steps in the setup process.
Below are the two things you can inject, the rendering engine and the file finder.

### Engine

By default, a Mustache rendering engine is setup. If you would like to use a
different engine you can set it with `set_engine`. Your engine will have to
implement the `\Owl\Engine` interface. The rendering engine is shared between
all view and layout classes, so you only need to set it once per request.

``` php
<?php

// Please don't do this as the Mustache engine is default, this is just an example
$engine = new \Owl\Engine\Mustache;
\Owl\View::set_engine($engine);
```

### File Finder

We need a way to find the template files to load and then eventually render. You
will need to specify a class that implement `\Owl\Finder` to do that. Provided
are a direct file system class and if you are using the Kohana framework, a finder
that uses the cascading file system (Badass!).

``` php
<?php

$path = __DIR__.DIRECTORY_SEPARATOR."views";
$finder = new \Owl\Finder\FileSystem($path);
\Owl\View::set_finder($finder);
```

## Usage

Now that you are setup, lets start creating your view classes and building your
application!

The first thing you will want to do is create a new class that extends \Owl\View.

``` php 
<?php

class Homepage extends \Owl\View
{
	public $name = "Dave";
	public $title = "Welcome";
}
```

Along with the view class you will need the mustache template. The template files
are loaded automatically from the template directory, based on the class name.
All underscores and namespace separators in the class name are converted to
directory separators. If you want to specify the full path to your files manually,
override the `get_file` function.

In our example above, we will want to create our template at
`__DIR__/views/Homepage.mustache`.

```
Hello {{name}}
```

Then all we will need to do is render our view class (echo works also).

``` php
<?php

// Assuming file finder is already set from above.
$content = new Homepage;

$content->render(); // Output: Hello Dave
// echo $content; <-- this works too
```

## Layout

The Owl library also comes with a layout class that can help you build reusable
layout files. Let's take a quick look at an example.

``` php
<?php

class Layout_Browser extends \Owl\Layout
{
	public $title = "My Page";
}
```

Our template file at `__DIR__/views/Layout/Browser.mustache` would then hold our
html page.

``` html
<!doctype html>
<html>
<head>
	<title>{{title}}</title>
</head>
<body>
	Content goes here...
</body>
</html>
```

This is great, but where it gets really dynamic is being able to add content
into the layout.

### Adding Content To a Layout

First we will need to modify our layout template file to have a content partial.

``` html
<body>
	{{> content}}
</body>
```

Then we can pass in either an \Owl\View class or raw html into the layout.

``` php
<?php

$layout = new Layout_Browser;
$layout->set_content($content);
$layout->render();
```

When the layout is rendered, it will replace the content partial {{> content}} with
the content you passed into the layout, which in our example is the Homepage view.

{{> content}} would then be replaced with Hello Dave. This lets you have a reusable
layout and change the page content based on the page. Pretty cool huh?

### Added To Layout

One last thing you should know about is the `added_to_layout` function.

When an \Owl\View extended class is passed into a layout class, the `added_to_layout`
function is called and the current layout is passed in as the only argument.

This is powerful because now you can use this function to add things to the layout.

Say you wanted to add some more js or css files because the specific page is a little
more dynamic or styled differently, you would do it in the `added_to_layout` function.

For a quick example, I will add the title from the view class onto the layout
title.

``` php
<?php

class Homepage extends \Owl\View
{
	public $name = "Dave";
	public $title = "Welcome";

	public function added_to_layout(\Owl\Layout $layout)
	{
		$layout->title .= "» {$this->title}";
	}
```

Now we the layout is rendered the title tag will render out as so.

`<title>My Page &raquo; Welcome</title>`

## Exploration

There is more to explore in the Owl library, but I'll leave that to you. If you
have any questions/bugs/concerns please use the bug tracker here on github.

## Hacking

If you use a different framework than those currently supported fork this repo
and add those files. The only thing I as is to please use and send pull requests
on the develop branch.

## License

This code is licensed under the [MIT](http://www.opensource.org/licenses/mit-license.php) license.

---

Developed by [Dave Widmer](http://www.davewidmer.net).
