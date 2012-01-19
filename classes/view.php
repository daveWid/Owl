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

}