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
	 * @var \Owl\View  The view class.
	 */
	private $view;

	/**
	 * Create a base view
	 */
	public function setUp()
	{
		$this->view = new BaseView;
	}

	/**
	 * Get the name of the view based on the filename 
	 */
	public function testFileName()
	{
		$this->assertEquals("BaseView.mustache", $this->view->getFile());
	}

	/**
	 * Test a simple load function. 
	 */
	public function testLoad()
	{
		$this->assertEquals("Welcome Dave", substr($this->view->render(), 0, 12));
	}

	/**
	 * Test the magic get/set functions
	 */
	public function testGetSet()
	{
		$this->view->name = "Nicholas";
		$this->assertEquals("Nicholas", $this->view->name);
	}

	/**
	 * Testing the batch parameters 
	 */
	public function testParams()
	{
		$this->view->set(array(
			'language' => "PHP"
		));

		$this->assertEquals("Dave", $this->view->name);
		$this->assertEquals("PHP", $this->view->language);
	}

}
