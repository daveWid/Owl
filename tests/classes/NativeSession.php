<?php

class NativeSession implements \Owl\Session
{
	public function __construct()
	{
		//session_start();
	}
	
	public function getOnce($name, $default = false)
	{
		$value = $default;
		
		if (isset($_SESSION[$name]))
		{
			$value = $_SESSION[$name];
			unset($_SESSION[$name]);
		}

		return $value;
	}

	public function set($name, $value)
	{
		$_SESSION[$name] = $value;
	}

	public function __destruct()
	{
		session_write_close();
	}
}