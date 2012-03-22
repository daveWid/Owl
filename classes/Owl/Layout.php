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
	public $charset = "utf-8";

	/**
	 * @var array  An array of css files in a href => , media => format
	 */
	public $css = array();

	/**
	 * @var array  An array of js files in a src => format
	 */
	public $js = array();

	/**
	 * @var array An array of metadata in a name => , content => format
	 */
	public $meta = array();

	/**
	 * @var string The page title.
	 */
	public $title = "";

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

		$this->content = $content;

		if ($content instanceof \Owl\View)
		{
			$content->added_to_layout($this);
			$this->partials['content'] = $this->load($content->file());
		}
		else
		{
			$this->partials['content'] = $content;
		}

		return $this;
	}

	/**
	 * Merges an array property of a layout in with the values supplied. This will
	 * be useful in the added_to_layout event hook.
	 *
	 * @param  string $name   The property name
	 * @param  array  $values An array of values to merge
	 * @return \Owl\Layout    $this
	 */
	public function merge($name, array $values)
	{
		if (isset($this->{$name}))
		{
			$this->{$name} = array_merge($this->{$name}, $values);
		}
		else
		{
			$this->{$name} = $values;
		}
	}

}
