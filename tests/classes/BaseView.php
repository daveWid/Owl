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
		$this->partials['list'] = $this->load("partials/list.mustache");
	}

	/**
	 * Inject in some variables.
	 *
	 * @param \Owl\Layout $layout  The layout this view was assed to.
	 */
	public function added_to_layout(\Owl\Layout $layout)
	{
		$layout->title .= $this->title;
	}

	/**
	 * Does the content have a list?
	 */
	public function has_list()
	{
		return empty($this->list) === false;
	}

}
	