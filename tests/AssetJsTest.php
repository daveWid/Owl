<?php

/**
 * Tests for JavaScript assets.
 *
 * @package   Owl
 * @author    Dave Widmer <dwidmer@bgsu.edu>
 */
class AssetJsTest extends PHPUnit_Framework_TestCase
{
	/**
	 * Run the Js class through its paces.
	 *
	 * @dataProvider get_data
	 */
	public function testJs($src, $expected)
	{
		$js = new \Owl\Asset\JavaScript($src);
		$this->assertEquals($expected, $js->__toString());
	}

	/**
	 * Get an array of data to run the tests with.
	 *
	 * @return array
	 */
	public function get_data()
	{
		return array(
			array("js/jquery.js", '<script src="js/jquery.js"></script>'),
		);
	}

}
