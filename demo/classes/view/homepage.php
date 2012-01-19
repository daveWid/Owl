<?php

class View_Homepage extends \Owl\View
{
	protected function get_file()
	{
		return "homepage.mustache";
	}
	
	public function name()
	{
		return isset($_GET['name']) ? $_GET['name'] : "";
	}

	public function add_to_layout()
	{
		return array(
			'title' => "Welcome",
			'js' => array(
				new \Owl\Asset\JavaScript("js/homepage.js")
			)
		);
	}

	public function partials()
	{
		return array(
			'greeting' => "partials/greeting.mustache",
		);
	}
}
	