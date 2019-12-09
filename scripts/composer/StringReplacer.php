<?php

namespace XWP\BlockPluginTemplateScripts;

/**
 * Wrapper around str_replace that accepts a string replace map.
 */
class StringReplacer {

	/**
	 * Map of string replacements.
	 *
	 * @var array
	 */
	protected $map;

	protected $keys;

	public function __construct( array $map ) {
		$this->map = $map;
		$this->keys = array_keys( $map );
	}

	public function do( string $string ) {
		return str_replace(
			$this->keys,
			$this->map,
			$string
		);
	}

}
