<?php

namespace Owl\Finder;

/**
 * Finds files from the file system when using the Kohana framework using the
 * Cascading File system. Bad-ass!
 *
 * @package   Owl
 * @author    Dave Widmer <dwidmer@bgsu.edu>
 */
class Kohana implements \Owl\Finder
{
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
		$info = pathinfo($file);
		$path = $info['dirname'].DIRECTORY_SEPARATOR.$info['filename'];
		$ext = $info['extension'];

		$found = \Kohana::find_file("views", $path, $ext);

		if ($found === false)
		{
			throw new \Owl\Exception("{$file} could not be found.");
		}

		return $found;
	}

}
