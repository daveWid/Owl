<?php

/**
 * The base view class.
 *
 * @package   Owl
 * @author    Dave Widmer <dwidmer@bgsu.edu>
 */
class ViewTest extends PHPUnit_Framework_TestCase
{
	/**
	 * Get the name of the view based on the filename 
	 */
	public function testFileName()
	{
		$view = new BaseView;
		$this->assertEquals("BaseView.mustache", $view->get_file());
	}

	/**
	 * Test a simple load function. 
	 */
	public function testLoad()
	{
		$view = new BaseView;
		$this->assertEquals("Welcome Dave", substr($view->render(), 0, 12));
	}

	/**
	 * Test the magic get/set functions
	 */
	public function testGetSet()
	{
		$view = new BaseView;
		$view->name = "Nicholas";

		$this->assertEquals("Nicholas", $view->name);
	}

	/**
	 * Testing the batch parameters 
	 */
	public function testParams()
	{
		$view = new BaseView;
		$view->set(array(
			'language' => "PHP"
		));

		$this->assertEquals("Dave", $view->name);
		$this->assertEquals("PHP", $view->language);
	}

	/**
	 * Test a full render cycle.
	 */
	public function testRender()
	{
		$view = new BaseView;

		$this->assertEquals("Welcome Dave", substr($view->render(), 0, 12));
	}

}
