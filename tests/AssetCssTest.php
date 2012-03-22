<?php

/**
 * Tests for CSS assets.
 *
 * @package   Owl
 * @author    Dave Widmer <dwidmer@bgsu.edu>
 */
class AssetCssTest extends PHPUnit_Framework_TestCase
{
	/**
	 * Run the CSS classs through its paces.
	 *
	 * @dataProvider get_data
	 */
	public function testCss($href, $media, $expected)
	{
		$css = new \Owl\Asset\Css($href, $media);
		$this->assertEquals($expected, $css->__toString());
	}

	/**
	 * Get an array of data to run the tests with.
	 *
	 * @return array
	 */
	public function get_data()
	{
		return array(
			array("css/style.css", null, '<link href="css/style.css" media="all" rel="stylesheet" type="text/css">'),
			array("css/base.css", "screen", '<link href="css/base.css" media="screen" rel="stylesheet" type="text/css">'),
			array("css/print.css", "print", '<link href="css/print.css" media="print" rel="stylesheet" type="text/css">'),
			array("css/layout.css", "all", '<link href="css/layout.css" media="all" rel="stylesheet" type="text/css">'),
		);
	}

}
