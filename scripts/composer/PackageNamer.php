<?php

namespace XWP\BlockPluginTemplateScripts;

class PackageNamer {

	protected $name;

	public function __construct( $name ) {
		$this->name = $this->sanitize_name( $name );
	}

	public function name() {
		return $this->name;
	}

	public function vendor() {
		$parts = explode( '/', $this->name );

		if ( 2 == count( $parts ) ) {
			return $parts[0];
		}

		return null;
	}

	public function slug() {
		$parts = explode( '/', $this->name );

		if ( 2 == count( $parts ) ) {
			return $parts[1];
		}

		return $this->name;
	}

	protected function sanitize_name( $name ) {
		return preg_replace(
			'/[^A-Za-z0-9-@\/]+/',
			'',
			$name
		);
	}

}
