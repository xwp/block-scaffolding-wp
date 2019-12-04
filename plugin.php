<?php
/**
 * Plugin Name: Block Plugin Template
 * Description: Block Plugin Template for WordPress
 * Version: 0.1.0
 * Author: XWP
 * Author URI: https://xwp.co
 * Text Domain: block-plugin-template
 */

namespace XWP\BlockPluginTemplate;

// Support for site-level autoloading.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}

$plugin = new BlockPluginTemplatePlugin( new Plugin( __FILE__ ) );

add_action( 'plugins_loaded', [ $plugin, 'init' ] );
