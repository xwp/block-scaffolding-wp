<?php
/**
 * Plugin Name: Block Scaffolding
 * Description: Block Scaffolding for WordPress.
 * Version: 1.0.0
 * Author: XWP
 * Author URI: https://github.com/xwp/block-scaffolding-wp
 * Text Domain: block-scaffolding
 *
 * @package BlockScaffolding
 */

namespace XWP\BlockScaffolding;

// Support for site-level autoloading.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}

$router = new Router( new Plugin( __FILE__ ) );

add_action( 'plugins_loaded', [ $router, 'init' ] );
