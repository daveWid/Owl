<?php

namespace Owl\Session;

/**
 * This class serves as an adapter to the Session claass in the Kohana framework.
 *
 * @package   Owl
 * @author    Dave Widmer <dwidmer@bgsu.edu>
 */
class Kohana implements \Owl\ISession
{
	/**
	 * Retrieve a session variable by the given name, if that session variable
	 * is not found, return the default value. Additionally, this function will
	 * clear out the session variable if found.
	 *
	 * @param  string $name     The property name
	 * @param  mixed  $default  The default value
	 * @return mixed            The property or default value
	 */
	public function get_once($name, $default = false)
	{
		return \Session::instance()->get_once($name, $default);
	}

	/**
	 * Sets a session value.
	 *
	 * @param  string $name   The property name
	 * @param  mixed  $value  The property value 
	 */
	public function set($name, $value)
	{
		\Session::instance()->set($name, $value);
	}
}
