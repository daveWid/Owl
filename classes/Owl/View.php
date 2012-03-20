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
	 * Renders the view into html
	 *
	 * @param  array $partials  An associative array of $name => $path partials
	 * @return string           The rendered HTML
	 */
	public function render(array $partials = array())
	{
		if ( ! empty($partials))
		{
			foreach ($partials as $key => $file)
			{
				$partials[$key] = $this->load($file);
			}
		}

		return $this->engine()->render($this->load(), $this, $partials);
	}

	/**
	 * Magic "get" method.
	 *
	 * @param  string $name The name of the propery to get
	 * @return mixed        The value
	 */
	public function __get($name)
	{
		return $this->{$name};
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
	 * Checks to see if the propery is set.
	 *
	 * @param  string $name The name of the property to check
	 * @return boolean
	 */
	public function __isset($name)
	{
		return isset($this->{$name});
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