<?php

namespace Owl;

/**
 * A Layout (template) View class.
 *
 * @package   Owl
 * @author    Dave Widmer <dwidmer@bgsu.edu>
 */
abstract class Layout extends \Owl\View
{
	/**
	 * @var \Owl\Owl The View class used as the content
	 */
	private $content = null;

	/**
	 * @var string The character set for the page
	 */
	protected $charset = "utf-8";

	/**
	 * @var array  An array of css files in a href => , media => format
	 */
	protected $css = array();

	/**
	 * @var array  An array of js files in a src => format
	 */
	protected $js = array();

	/**
	 * @var array An array of metadata in a name => , content => format
	 */
	protected $meta = array();

	/**
	 * @var string The page title.
	 */
	protected $title = "";

	/**
	 * Getter/Setter for the content variable
	 *
	 * @param  Owl\View $view The view to set at the content
	 * @return Owl\View       The content view file
	 */
	public function content(\Owl\View $view = null)
	{
		if ($view === null)
		{
			return $this->content;
		}

		$this->content = $view;

		$add = $view->add_to_template();
		if ( ! empty($add))
		{
			foreach ($add as $key => $data)
			{
				$this->set($key, $data);
			}
		}
	}

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
		return isset($name);
	}

}
