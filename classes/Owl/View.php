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
	 * @var \Owl\Engine  The rendering engine used to compile the views.
	 */
	private static $engine = null;

	/**
	 * The template rendering engine.
	 *
	 * @return \Owl\Engine  The template rendering engine.
	 */
	public static function get_engine()
	{
		return self::$engine;
	}

	/**
	 * Sets the template rendering engine. The engine is static across all
	 * View classes so you will only need to set it once.
	 *
	 * @param \Owl\Engine $engine  The rendering engine
	 */
	public static function set_engine(\Owl\Engine $engine)
	{
		self::$engine = $engine;
	}

	/**
	 * @var \Owl\Finder  The class used to find template files
	 */
	private static $finder = null;

	/**
	 * Gets the finder.
	 *
	 * @return \Owl\Finder
	 */
	public static function get_finder()
	{
		return self::$finder;
	}

	/**
	 * Set the file finder.
	 *
	 * @param \Owl\Finder $finder  The file finder class
	 */
	public static function set_finder(\Owl\Finder $finder)
	{
		self::$finder = $finder;
	}

	/**
	 * Creates a new View instance, if the rendering engine isn't set, it will
	 * default to the Mustache engine.
	 */
	public function __construct()
	{
		if (self::get_engine() === null)
		{
			self::set_engine(new \Owl\Engine\Mustache);
		}
	}

	/**
	 * @var array  A list of partials in $name => $template_file_path format.
	 */
	protected $partials = array();

	/**
	 * Sets parameters in a batch way.
	 *
	 * @param  mixed $name   The property name OR an array of params
	 * @param  mixed $value  The value of the property if not an array
	 * @return \Owl\View     $this
	 */
	public function set($name, $value = null)
	{
		if (is_array($name) === false)
		{
			$name = array($name => $value);
		}

		foreach ($name as $key => $value)
		{
			$this->{$name} = $value;
		}

		return $this;
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
	public function get_file()
	{
		// Normalize namespace separators
		$file = str_replace(array("\\", "_"), DIRECTORY_SEPARATOR, get_class($this));
		return $file.".mustache";
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
			$file = $this->get_file();
		}

		return file_get_contents(self::get_finder()->find($file));
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
		return self::get_engine()->render($this->load(), $this, $partials);
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