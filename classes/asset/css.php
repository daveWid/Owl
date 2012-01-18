<?php

namespace Owl\Asset;

/**
 * A CSS asset for an Owl view
 *
 * @package   Owl
 * @author    Dave Widmer <dwidmer@bgsu.edu>
 */
class Css
{
	/**
	 * @var string  The href for the link
	 */
	public $href;

	/**
	 * @var string   The media type
	 */
	public $media;

	/**
	 * Creates a new CSS view asset.
	 *
	 * @param string $href   The link href
	 * @param string $media  The media type
	 */
	public function __construct($href, $media = "screen")
	{
		$this->href = $href;
		$this->media = $media;
	}

}
