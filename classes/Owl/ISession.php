<?php

namespace Owl;

/**
 * The ISession interface is used to define a session driver that can be used
 * to set and get session data for the Owl library.
 *
 * @package   Owl
 * @author    Dave Widmer <dwidmer@bgsu.edu>
 */
interface ISession
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
	public function get_once($name, $default = false);

	/**
	 * Sets a session value.
	 *
	 * @param  string $name   The property name
	 * @param  mixed  $value  The property value 
	 */
	public function set($name, $value);

}
