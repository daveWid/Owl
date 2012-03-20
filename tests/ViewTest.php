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
	 * Make sure we can get and set the engine 
	 */
	public function testEngine()
	{
		$mustache = new Mustache;
		$view = new BaseView;
		$view->engine($mustache);

		$this->assertInstanceOf("Mustache", $view->engine());
	}

	/**
	 * Make sure we can share the engine across multiple instances. 
	 */
	public function testSharedEngine()
	{
		$mustache = new Mustache;
		$first = new BaseView;
		$first->engine($mustache);

		$second = new BaseView;

		$this->assertInstanceOf("Mustache", $second->engine());
	}

	/**
	 * Testing the template path getter/setter 
	 */
	public function testTemplatePath()
	{
		$path = __DIR__.DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR;
		$view = new BaseView;
		$view->template_path($path);

		$this->assertEquals($path, $view->template_path());
	}

	/**
	 * Make sure that template_path adds a directory separator
	 */
	public function testTemplatePathAddsSeparator()
	{
		$path = __DIR__.DIRECTORY_SEPARATOR."views";
		$view = new BaseView;
		$view->template_path($path);

		$this->assertNotEquals($path, $view->template_path());
	}

	/**
	 * Sharing of the template path
	 */
	public function testTemplatePathShared()
	{
		$path = __DIR__.DIRECTORY_SEPARATOR."views";
		$first = new BaseView;
		$second = new BaseView;

		$first->template_path($path);

		$this->assertEquals($first->template_path(), $second->template_path());
	}

	/**
	 * Get the name of the view based on the filename 
	 */
	public function testFileName()
	{
		$view = new BaseView;
		$this->assertEquals("BaseView.mustache", $view->file());
	}

	/**
	 * Test a simple load function. 
	 */
	public function testLoad()
	{
		$view = new BaseView;
		$this->assertEquals("Welcome {{name}}", $view->load());
	}

	/**
	 * Test the magic get/set functions
	 */
	public function testGetSet()
	{
		$view = new BaseView;
		$view->name = "Dave";

		$this->assertEquals("Dave", $view->name);
	}

	/**
	 * Testing the batch parameters 
	 */
	public function testParams()
	{
		$view = new BaseView;
		$view->params(array(
			'name' => "Dave",
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
		$view->engine(new Mustache);

		// Dynamic variable setting
		$view->name = "Dave";

		$this->assertEquals("Welcome Dave", $view->render());
	}

}
