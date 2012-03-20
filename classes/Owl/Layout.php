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
	 * @var mixed  The content to inject into the view.
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
	 * The layout content that will replace {{{content}}} in the template.
	 *
	 * @param  mixed $content  The content to inject into the template
	 * @return mixed           The content [get] OR $this [set]
	 */
	public function content($content = null)
	{
		if ($content === null)
		{
			return $this->content;
		}

		if ($content instanceof \Owl\View)
		{
			$content = $content->render();
		}

		$this->content = $content;
	}

}
