<?php

namespace Owl\Asset;

/**
 * A Metadata asset for an Owl view
 *
 * @package   Owl
 * @author    Dave Widmer <dwidmer@bgsu.edu>
 */
class Meta
{
	/**
	 * @var string  The metadata name
	 */
	public $name;

	/**
	 * @var string  The content for the metadata
	 */
	public $content;

	/**
	 * Creates a new Meta view asset.
	 *
	 * @param string $name     The metadata name
	 * @param string $content  The content
	 */
	public function __construct($name, $content)
	{
		$this->name = $name;
		$this->content = $content;
	}

}
