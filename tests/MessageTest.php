<?php

/**
 * Testing out the Message class.
 *
 * @package   Owl
 * @author    Dave Widmer <dwidmer@bgsu.edu>
 */
class MessageTest extends PHPUnit_Framework_TestCase
{
	/**
	 * Setup the session instance
	 */
	public function setUp()
	{
		$session = new NativeSession;
		\Owl\Message::set_session($session);

		parent::setUp();
	}

	/**
	 * Running through a message's lifecycle and see if everything works as planned.
	 */
	public function testLifecycle()
	{
		$this->assertFalse(\Owl\Message::get());

		\Owl\Message::error("There was a problem");

		$message = \Owl\Message::get();
		$this->assertInstanceOf("\\Owl\\Message", $message);
		$this->assertSame("There was a problem", $message->message);
		$this->assertSame('error', $message->type);

		$this->assertFalse(\Owl\Message::get());
	}

}