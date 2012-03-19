<?php

namespace Owl;

/**
 * Autoloading Owl classes.
 *
 * @package   Owl
 * @author    Dave Widmer <dwidmer@bgsu.edu>
 */
class Autoloader
{
	/**
	 * @var string The base path to load classes.
	 */
	private $path;

	/**
	 * @var string The file extension to add to autoloaded files.
	 */
	public $extension;

	/**
	 * Creates a new autoloader.
	 *
	 * @param string $path The path from where to autoload classes
	 * @param string $ext  The file extension
	 */
	public function __construct($path, $ext = ".php")
	{
		$this->path = rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
		$this->extension = $ext;
	}

	/**
	 * Class autoloading.
	 *
	 * @param string $class The name of a class to load
	 */
	public function autoload($class)
	{
		// Only autoload Owl classes
		if (preg_match("/^owl/i", $class) === 0)
		{
			return;
		}

		// Replace all namespace separators with directory separators and
		// remove Owl\ from the beginning
		$file = str_replace("\\", DIRECTORY_SEPARATOR, substr($class, 4));
		$full_path = strtolower($this->path.$file.$this->extension);

		if (is_file($full_path))
		{
			include $full_path;
		}
	}

	/**
	 * Registers the autoloader.
	 */
	public function register()
	{
		spl_autoload_register(array($this, "autoload"));
	}

	/**
	 * Unregisters the autoloader.
	 */
	public function unregister()
	{
		spl_autoload_unregister(array($this, "autoload"));
	}

	/**
	 * Unregister the autoload when the object is removed.
	 */
	public function __destruct()
	{
		$this->unregister();
	}

}
