<?php

namespace Owl\Engine;

/**
 * The rendering engine using Mustache.
 *
 * @package   Owl
 * @author    Dave Widmer <dwidmer@bgsu.edu>
 */
class Mustache implements \Owl\Engine
{
	/**
	 * Mustache_Engine  The mustache rendering engine.
	 */
	private $mustache;

	/**
	 * Creates a new mustache engine.
	 */
	public function __construct()
	{
		$this->mustache = new \Mustache_Engine;
	}

	/**
	 * Render the given template and view object.
	 *
	 * @param  string $template  The template to render
	 * @param  mixed  $data      The view object (or array) to add'
	 * @param  array  $partials  A list of partials
	 * @return string            The rendered template in html
	 */
	public function render($template, $data, $partials = array())
	{
		$this->mustache->setPartials($partials);
		return $this->mustache->render($template, $data);
	}

}
