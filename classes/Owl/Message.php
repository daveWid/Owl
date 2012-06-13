<?php

namespace Owl;

/**
 * The Message class lets you set "flash" messages from one part of your application
 * so they can be viewed in another.
 *
 * @package   Owl
 * @author    Dave Widmer <dwidmer@bgsu.edu>
 */
class Message
{
	/**
	 * @var \Owl\ISession  The object to use to to save the session data.
	 */
	private static $session = null;

	/**
	 * Set the session class used within this class.
	 *
	 * @param ISession $session 
	 */
	public static function set_session(ISession $session)
	{
		self::$session = $session;
	}

	/**
	 * Gets the current message.
	 *
	 * @return mixed  The currently stored message or FALSE
	 */
	public static function get()
	{
		return self::$session->get_once('owl_flash', FALSE);
	}

	/**
	 * Sets a flash message.
	 *
	 * @param string   Type of message
	 * @param mixed    Array/String for the message
	 */
	public static function set($type, $message)
	{
		self::$session->set('owl_flash', new \Owl\Message($type, $message));
	}

	/**
	 * Sets an error message.
	 *
	 * @param mixed  String/Array for the message(s)
	 */
	public static function error($message)
	{
		self::set('error', $message);
	}

	/**
	 * Sets a notice.
	 *
	 * @param mixed  String/Array for the message(s)
	 */
	public static function notice($message)
	{
		self::set('notice', $message);
	}

	/**
	 * Sets a success message.
	 *
	 * @param mixed  String/Array for the message(s)
	 */
	public static function success($message)
	{
		self::set('success', $message);
	}

	/**
	 * Sets a warning message.
	 *
	 * @param mixed  String/Array for the message(s)
	 */
	public static function warn($message)
	{
		self::set('warn', $message);
	}

	/**
	 * @var mixed   The message to display.
	 */
	public $message;

	/**
	 * @var string  The type of message.
	 */
	public $type;

	/**
	 * Creates a new Message instance.
	 *
	 * @param string $type     Type of message
	 * @param mixed  $message  Message to display, either string or array
	 */
	public function __construct($type, $message)
	{
		$this->type = $type;
		$this->message = $message;
	}

}
