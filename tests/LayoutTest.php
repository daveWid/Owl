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
	 * Set the template path 
	 */
	public function setUp()
	{
		$this->layout = new LayoutView;

		$path = __DIR__.DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR;
		$this->layout->template_path($path);
		$this->layout->engine(new Mustache);

		parent::setUp();
	}
	
	/**
	 * Testing the setting of the content
	 */
	public function testAddingContent()
	{
		$content = new BaseView;
		$this->layout->content($content);

		// Partial
		$this->assertArrayHasKey("content", $this->layout->get_partials());

		// Fired added_to_layout correctly
		$this->assertObjectHasAttribute("name", $this->layout);
	}

	/**
	 * Making sure that the merge function is working correctly.
	 */
	public function testMerge()
	{
		$css = array(
			new \Owl\Asset\Css("css/layout.css"),
			new \Owl\Asset\Css("css/style.css"),
		);

		// Merge just adds at beginning
		$this->layout->merge('css', $css);
		$this->assertCount(2, $this->layout->css);

		// Merge appends with existing values
		$this->layout->css = $this->layout->css = array(
			new \Owl\Asset\Css("css/base.css")
		);
		$this->layout->merge("css", $css);
		$this->assertCount(3, $this->layout->css);
	}

}
