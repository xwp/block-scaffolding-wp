<?php

namespace XWP\BlockPluginTemplateScripts;

use Composer\Script\Event;

class PluginScaffolder {

	const TEMPLATE_VENDOR = 'XWP';

	const TEMPLATE_SLUG = 'block-plugin-template';

	public static function scaffold( Event $event ) {
		$io = $event->getIO();

		$default_package_name = sprintf(
			'%s/%s',
			self::TEMPLATE_VENDOR,
			self::TEMPLATE_SLUG
		);

		$desired_package_name = $io->ask(
			'Enter the desired package name (vendor/plugin-name): ',
			$default_package_name
		);

		$package = new PackageNamer( $desired_package_name );

		$replacer = new StringReplacer(
			array_combine(
				self::slug_to_string_map( self::TEMPLATE_VENDOR, self::TEMPLATE_SLUG ),
				self::slug_to_string_map( $package->vendor(), $package->slug() )
			)
		);

		/**
		 * For each file in the project directory:
		 *
		 * 1. Rename strings in file.
		 * 2. Rename the file.
		 */
	}

	protected static function project_files() {
		return glob( sprintf( '%s/*', getcwd() ) );
	}

	protected static function slug_to_string_map( $vendor, $slug ) {
		$slug = strtolower( $slug );
		$parts = array_map( 'ucfirst', explode( '-', $slug ) );

		return [
			sprintf( '%s/%s', $vendor, $slug ), // VENDOR/package-slug
			sprintf( '%s\\%s\\', $vendor, $slug ), // VENDOR\package-slug\
			sprintf( '%s\\\\%s\\\\', $vendor, $slug ), // VENDOR\\package-slug\\
			sprintf( '%s/%s', strtolower( $vendor ), $slug ), // vendor/package-slug
			sprintf( '@%s/%s', strtolower( $vendor ), $slug ), // @vendor/package-slug
			$slug, // package-slug
			implode( ' ', $parts ), // Package Slug
			implode( '', $parts ), // PackageSlug
		];
	}
}
