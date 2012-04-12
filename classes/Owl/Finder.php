<?php

namespace Owl;

/**
 * This interface specifies the methods necessary locate template files.
 *
 * @package   Owl
 * @author    Dave Widmer <dwidmer@bgsu.edu>
 */
interface Finder
{
	/**
	 * Given the filename, attempts to find a file in the filesystem.
	 *
	 * @throws \Owl\Exception  When a file can't be found
	 *
	 * @param  string $file    The name of the file
	 * @return string          The full file path to the file 
	 */
	public function find($file);

}