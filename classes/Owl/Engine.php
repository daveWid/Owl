<?php

namespace Owl;

/**
 * This interface specifies the methods necessary to be compatible with the Owl
 * library as a template rendering engine.
 *
 * @package   Owl
 * @author    Dave Widmer <dwidmer@bgsu.edu>
 */
interface Engine
{
	/**
	 * Render the given template and view object.
	 *
	 * @param  string $template  The template to render
	 * @param  mixed  $view      The view object (or array) to add
	 * @param  array  $partials  Any partials
	 * @return string            The rendered template in html
	 */
	public function render($template = null, $view = null, $partials = null);

}