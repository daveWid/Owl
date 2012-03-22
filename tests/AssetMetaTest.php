<?php

/**
 * Tests for Meta assets.
 *
 * @package   Owl
 * @author    Dave Widmer <dwidmer@bgsu.edu>
 */
class AssetMetaTest extends PHPUnit_Framework_TestCase
{
	/**
	 * Run the Meta class through its paces.
	 *
	 * @dataProvider get_data
	 */
	public function testMeta($name, $content, $expected)
	{
		$meta = new \Owl\Asset\Meta($name, $content);
		$this->assertEquals($expected, $meta->__toString());
	}

	/**
	 * Get an array of data to run the tests with.
	 *
	 * @return array
	 */
	public function get_data()
	{
		return array(
			array("viewport", "width=device-width,initial-scale=1", '<meta name="viewport" content="width=device-width,initial-scale=1">'),
			array("author", "Dave", '<meta name="author" content="Dave">'),
		);
	}

}
