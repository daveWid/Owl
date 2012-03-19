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
	 * @param  boolean        Automatically render the content? (true will let you debug)
	 * @return Owl\View       The content view file
	 */
	public function content(\Owl\View $view = null, $render = true)
	{
		if ($view === null)
		{
			return $this->content;
		}

		$this->content = $render ? $view->render() : $view;

		$add = $view->add_to_layout();
		if ( ! empty($add))
		{
			foreach ($add as $key => $data)
			{
				$this->set($key, $data);
			}
		}
	}

}
