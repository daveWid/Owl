# Owl

Owl is a view library that uses [Mustache](https://github.com/bobthecow/mustache.php)
as the rendering engine. Requires PHP 5.3+.

## Downloading

Visit the [downloads](https://github.com/BGSU-LITS/Owl/downloads) page and click
on the latest version to grab the files.

Once you have the files downloaded and unzipped, move the classes over to your
application.

## Autoloading

Owl fully supports [PSR-0](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md)
autoloading. If you don't already have PSR-0 support in your application, include
the bootstrap.php file which will setup autoloading of the Owl library for you.

## Setup

The Owl library needs two options set before it will work correctly. The first
is the rendering engine.

``` php
<?php

$content = new \Owl\View;
$content->set_engine(new Mustache);
```

The rendering engine is shared between all view and layout classes, so you only
need to set it once per request.

The same holds true with the template path, which points to the folder where you
are holding your mustache template files. You can set it like so.

``` php
<?php

$path = __DIR__.DIRECTORY_SEPARATOR."template"; // <-- replace with a real path of course!
$content->set_template_path($path);
```

## Usage

You are now ready to start creating your view classes and building your webpages!

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
`$template_path/Homepage.mustache`.

```
Hello {{name}}
```

Then all we will need to do is render our view class (echo works also).

``` php
<?php

$content = new Homepage;
$content->set_engine(new Mustache);
$content->set_template_path($path);

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

Our template file at `$template_path/Layout/Browser.mustache` would then hold our
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

Feel free to hack away on the develop branch and send pull requests!

## License

This code is licensed under the [MIT](http://www.opensource.org/licenses/mit-license.php) license.

---

Developed by [BGSU Library ITS](http://ul2.bgsu.edu/labs).
