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
	 * @var boolean  Does this layout have an \Owl\View?
	 */
	private $has_view = false;

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
			$this->has_view = true;
		}
		else
		{
			$this->partials['content'] = $content;
			$this->has_view = false;
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

	/**
	 * Pass in the content partials to the rendering function.
	 *
	 * @param  array $partials  An array of partials
	 * @return string           The rendered template
	 */
	public function render(array $partials = array())
	{
		if ($this->has_view)
		{
			$partials = array_merge($this->content->get_partials(), $partials);
		}

		return parent::render($partials);
	}

	/**
	 * Allowing access to content properties (if a \Owl\View instance)
	 *
	 * @param  string $name  The name of the property to get
	 * @return mixed
	 */
	public function __get($name)
	{
		if (method_exists($this->content, $name))
		{
			return $this->content->{$name}();
		}
		else
		{
			return $this->content->{$name};
		}
	}

	/**
	 * Checks to see if a variable is available in the content.
	 *
	 * @param  string $name  The name of the property to check
	 * @return boolean
	 */
	public function __isset($name)
	{
		$set = false;

		if ($this->has_view)
		{
			if (isset($this->content->{$name}) OR method_exists($this->content, $name))
			{
				$set = true;
			}
		}

		return $set;
	}

}
