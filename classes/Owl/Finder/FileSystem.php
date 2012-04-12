<?php

namespace Owl\Finder;

/**
 * Finds files from the file system. It will look through the base directory
 * for the file
 *
 * @package   Owl
 * @author    Dave Widmer <dwidmer@bgsu.edu>
 */
class FileSystem implements \Owl\Finder
{
	/**
	 * @var string  The base path to look for files
	 */
	private $path;

	/**
	 * Creates a new file system file lookup. You will need to supply the base
	 * path.
	 *
	 * @param string $path  The full base path.
	 */
	public function __construct($path)
	{
		$this->set_path($path);
	}

	/**
	 * Gets the base path.
	 *
	 * @return string
	 */
	public function get_path()
	{
		return $this->path;
	}

	/**
	 * Sets the base path for file lookup.
	 *
	 * @param  string $path            The full server path to use as a starting point
	 * @return \Owl\Finder\FileSystem  $this
	 */
	public function set_path($path)
	{
		$this->path = rtrim($path, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
	}

	/**
	 * Given the filename, attempts to find a file in the filesystem.
	 *
	 * @throws \Owl\Exception  When a file can't be found
	 *
	 * @param  string $file    The name of the file
	 * @return string          The full file path to the file 
	 */
	public function find($file)
	{
		$path = $this->path.$file;
		if ( ! is_file($path))
		{
			throw new \Owl\Exception("{$file} could not be found.");
		}

		return $path;
	}

}
