<?php

namespace Owl;

/**
 * The base view class.
 *
 * @package   Owl
 * @author    Dave Widmer <dwidmer@bgsu.edu>
 */
abstract class View
{
	/**
	 * @var string  The full path to the mustache template directory
	 */
	public static $template_path = ".";

	/**
	 * @var Mustach The mustache instance used to render the views.
	 */
	public static $renderer = null;

	/**
	 * @var string The mustache template
	 */
	private $template = null;

	/**
	 * @var string  The rendered template (useful for caching)
	 */
	private $rendered = null;

	/**
	 * Getter/Setter for the mustache template file
	 *
	 * @param  string $file  The mustache file
	 * @return string
	 */
	public function file($file = null)
	{
		if ($file === null)
		{
			return $this->get_file();
		}

		$this->file = $file;
		return $this->file;
	}

	/**
	 * Gets the template.
	 *
	 * @return  string  The mustache template
	 */
	public function template()
	{
		if ($this->template === null)
		{
			$file = View::$template_path.$this->file();
			$this->template = file_get_contents($file);
		}

		return $this->template;
	}

	/**
	 * Renders the view into html
	 *
	 * @return string  The rendered HTML
	 */
	public function render()
	{
		if ($this->rendered === null)
		{
			$this->rendered = View::$renderer->render($this->template(), $this);
		}

		return $this->rendered;
	}

	/**
	 * Renders the view to html.
	 *
	 * @return string 
	 */
	public function __toString()
	{
		return $this->render();
	}

	/**
	 * Lets you add things to a layout.
	 *
	 * @return array Associative array of things to add.
	 */
	public function add_to_layout()
	{
		return array();
	}

	/**
	 * Forcing the template file to be specified in all subclasses.
	 *
	 * @return string
	 */
	abstract protected function get_file();

	/**
	 * Gets the class property by name
	 *
	 * @param string $name  The name of the property to get
	 */
	public function get($name, $default = null)
	{
		return isset($this->{$name}) ? $this->{$name} : $default;
	}

	/**
	 * Sets a class property, optionally overwriting the data instead of appending.
	 *
	 * @param  string  $name       The property name
	 * @param  mixed   $value      The value to set
	 * @param  boolean $overwrite  Overwrite the current value?
	 * @return $this
	 */
	public function set($name, $value, $overwrite = false)
	{
		// Make sure we have a property if overwriting is turned on
		$current = $this->get($name);
		if ($overwrite AND $current === null)
		{
			$overwrite = false;
		}

		if ($overwrite)
		{
			$this->{$name} = $value;
		}
		else
		{
			if (is_array($value) OR is_object($value))
			{
				$this->{$name} = array_merge($current, $value);
			}
			else if(is_string($value))
			{
				$this->{$name} .= $value;
			}
			else
			{
				// If not a string, object or array, then just overwrite no matter what...
				$this->{$name} = $value;
			}
		}

		return $this;
	}

	/**
	 * Magic "get" method.
	 *
	 * @param  string $name The name of the propery to get
	 * @return mixed        The value
	 */
	public function __get($name)
	{
		return $this->get($name, null);
	}

	/**
	 * Magic "set" method
	 *
	 * @param string $name  The propery name
	 * @param mixed  $value The value to set
	 */
	public function __set($name, $value)
	{
		$this->set($name, $value, true);
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
		return $this->render();
	}

}