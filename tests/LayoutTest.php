<?php

/**
 * Tests for the Layout class
 *
 * @package   Owl
 * @author    Dave Widmer <dwidmer@bgsu.edu>
 */
class LayoutTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var \Owl\Layout  The layout to use in the tests.
	 */
	public $layout;

	/**
	 * @var \Owl\View    The base view
	 */
	public $view;

	/**
	 * Set the template path 
	 */
	public function setUp()
	{
		$path = __DIR__.DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR;

		$finder = new \Owl\Finder\FileSystem($path);
		\Owl\View::setFinder($finder);

		$this->layout = new LayoutView;
		$this->view = new BaseView;

		parent::setUp();
	}

	/**
	 * Test the fetching of content.
	 */
	public function testContent()
	{
		// View content...
		$this->layout->setContent($this->view);
		$this->assertInstanceOf("Owl\\View", $this->layout->getContent());

		// Raw html
		$this->layout->setContent("<h1>Hello World</h1>");
		$this->assertInternalType("string", $this->layout->getContent());
	}

	/**
	 * Testing the setting of the content
	 */
	public function testContentPartial()
	{
		$this->layout->setContent($this->view);
		$this->assertArrayHasKey("content", $this->layout->getPartials());
	}

	/**
	 * Make sure that the layout can access the variables of the content.
	 */
	public function testContentPassthru()
	{
		$this->layout->setContent($this->view);

		$this->assertTrue(isset($this->layout->name));
		$this->assertRegExp("/<title>Owl Testing!<\/title>/", $this->layout->render());
	}

	/**
	 * Making sure that the added to layout function is working correctly.
	 */
	public function testAddedToLayout()
	{
		$this->layout->setContent($this->view);
		$this->assertCount(1, $this->layout->css); // Added from the BaseView
	}

	public function testRenderWithHTML()
	{
		$this->layout->setContent("<h1>Injected HTML</h1>");
		$this->assertRegExp("/<h1>Injected HTML<\/h1>/", $this->layout->render());
	}

}
