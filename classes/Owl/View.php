<?php

namespace Owl;

/**
 * The base View class.
 *
 * @package   Owl
 * @author    Dave Widmer <dwidmer@bgsu.edu>
 */
abstract class View
{
	/**
	 * @var mixed  The rendering engine used to compile the views.
	 */
	private static $engine = null;

	/**
	 * @var string  The path to the folder that holds the templates.
	 */
	private static $template_path = ".";

	/**
	 * @var array  A list of partials in $name => $template_file_path format.
	 */
	protected $partials = array();

	/**
	 * @var string  The extension for the template files
	 */
	protected $extension = "mustache";

	/**
	 * The rendering engine.
	 *
	 * @param mixed $engine  The class to used as the rendering engine
	 * @return               The rendering engine [get] OR $this [set]
	 */
	public function engine($engine = null)
	{
		if ($engine === null)
		{
			return self::$engine;
		}

		self::$engine = $engine;
		return $this;
	}

	/**
	 * The path where all of the templates are.
	 *
	 * @param  string $path  The full server path
	 * @return mixed         The template path [get] OR $this [set]
	 */
	public function template_path($path = null)
	{
		if ($path === null)
		{
			return self::$template_path;
		}

		self::$template_path = rtrim($path, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
		return $this;
	}

	/**
	 * Sets parameters in a batch way.
	 *
	 * @param array $params  An associative array of $name => $value pairs
	 */
	public function params(array $params)
	{
		foreach ($params as $name => $value)
		{
			$this->{$name} = $value;
		}
	}

	/**
	 * The partials for this view.
	 *
	 * @return array
	 */
	public function get_partials()
	{
		return $this->partials;
	}

	/**
	 * Gets the name of the template file (relative to the template path)
	 *
	 * @return string
	 */
	public function file()
	{
		// Normalize namespace separators
		$file = str_replace(array("\\", "_"), DIRECTORY_SEPARATOR, get_class($this));
		return $file.".".$this->extension;
	}

	/**
	 * Loads a template
	 *
	 * @param  string $file  The path of the template file (relative to the $templates_directory)
	 * @return string        The full template
	 */
	public function load($file = null)
	{
		if ($file === null)
		{
			$file = $this->file();
		}

		return file_get_contents($this->template_path().$file);
	}

	/**
	 * Runs when the view is added to a layout. This will let you assign variables
	 * into the layout.
	 *
	 * @param \Owl\Layout $layout  The layout that this view was added to
	 */
	public function added_to_layout(\Owl\Layout $layout)
	{
		// This does nothing by default...
	}

	/**
	 * Renders the view into html. All passed in partials should be the full
	 * template.
	 *
	 * @param  array $partials  An associative array of $name => $template
	 * @return string           The rendered HTML
	 */
	public function render(array $partials = array())
	{
		$partials = array_merge($this->partials, $partials);
		return $this->engine()->render($this->load(), $this, $partials);
	}

	/**
	 * Magic "set" method
	 *
	 * @param string $name  The propery name
	 * @param mixed  $value The value to set
	 */
	public function __set($name, $value)
	{
		$this->{$name} = $value;
	}

	/**
	 * Renders the view to html.
	 *
	 * @return string
	 */
	public function __toString()
	{
		try {
			return $this->render();
		} catch (\Exception $e) {
			echo $e;
		}
	}

}