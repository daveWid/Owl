<?php

/**
 * Tests the Form Option class.
 *
 * @package   Owl
 * @author    Dave Widmer <dwidmer@bgsu.edu>
 */
class FormOptionTest extends PHPUnit_Framework_TestCase
{
	/**
	 * Run the Form option classs through its paces.
	 *
	 * @dataProvider get_data
	 */
	public function testFormOption($value, $label, $selected, $is_selected)
	{
		$option = new \Owl\Form\Option($value, $label, $selected);
		$this->assertEquals($is_selected, $option->selected);
	}

	/**
	 * Get an array of data to run the tests with.
	 *
	 * @return array
	 */
	public function get_data()
	{
		return array(
			array("OH", "Ohio", "OH", true),
			array("MI", "Michigan", "OH", false),
			array("IN", "Indiana", "OH", false),
		);
	}

}
