<?php

class BaseView extends \Owl\View
{
	public $name = "Dave";
	public $title = "Owl Testing!";

	/**
	 * Inject in some variables.
	 *
	 * @param \Owl\Layout $layout  The layout this view was assed to.
	 */
	public function added_to_layout(\Owl\Layout $layout)
	{
		$layout->title .= $this->title;
		$layout->name = $this->name;
	}

}
	