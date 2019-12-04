<?php
/**
 * Plugin Name: Block Extend
 * Description: Extend Gutenberg editor blocks.
 * Version: 0.1.0
 * Author: XWP
 * Author URI: https://xwp.co
 * Text Domain: block-extend
 *
 * @package BlockExtend
 */

namespace XWP\BlockExtend;

// Support for site-level autoloading.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}

$router = new Router( new Plugin( __FILE__ ) );

add_action( 'plugins_loaded', [ $router, 'init' ] );
