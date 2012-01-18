<?php

class View_Layout_Browser extends \Owl\Layout
{
	protected function get_file()
	{
		return "browser.mustache";
	}

	protected $title = "Owl Demo » ";

	/**
	 * Set default values for a browser layout
	 */
	public function __construct()
	{
		$this->set('css', array(
			new \Owl\Asset\Css("css/style.css", "screen")
		))
		->set('js', array(
			new \Owl\Asset\JavaScript("js/common.js")
		))
		->set('meta', array(
			new \Owl\Asset\Meta('author', "Dave Widmer")
		));
	}

}
