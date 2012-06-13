<?php

class BaseView extends \Owl\View
{
	public $name = "Dave";
	public $title = "Owl Testing!";

	public $list = array(
		"apple","orange","lemon","lime"
	);

	/**
	 * Sets up some partials.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->partials['list'] = $this->load("partials/list.mustache");
	}

	/**
	 * Inject in some variables.
	 *
	 * @param \Owl\Layout $layout  The layout this view was assed to.
	 */
	public function addedToLayout(\Owl\Layout $layout)
	{
		$layout->title .= $this->title;
		$layout->css[] = new \Owl\Asset\Css("css/slideshow.css");
	}

	/**
	 * Does the content have a list?
	 */
	public function hasList()
	{
		return empty($this->list) === false;
	}

}
	