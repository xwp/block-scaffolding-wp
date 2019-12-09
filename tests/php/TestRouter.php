<?php
/**
 * Tests for Router class.
 *
 * @package BlockScaffolding
 */

namespace XWP\BlockScaffolding;

use Mockery;
use WP_Mock;

/**
 * Tests for the Router class.
 */
class TestRouter extends TestCase {

	/**
	 * Test init.
	 *
	 * @covers \XWP\BlockScaffolding\Router::init()
	 */
	public function test_init() {
		$plugin = new Router( Mockery::mock( Plugin::class ) );

		WP_Mock::expectActionAdded( 'enqueue_block_editor_assets', [ $plugin, 'enqueue_editor_assets' ], 10, 1 );

		$plugin->init();
	}

	/**
	 * Test enqueue_editor_assets.
	 *
	 * @covers \XWP\BlockScaffolding\Router::enqueue_editor_assets()
	 */
	public function test_enqueue_editor_assets() {
		$plugin = Mockery::mock( Plugin::class );

		$plugin->shouldReceive( 'asset_url' )
			->once()
			->with( 'js/dist/editor.js' )
			->andReturn( 'http://example.com/js/dist/editor.js' );

		$plugin->shouldReceive( 'asset_version' )
			->once()
			->andReturn( '1.2.3' );

		WP_Mock::userFunction( 'wp_enqueue_script' )
			->once()
			->with(
				'block-scaffolding-js',
				'http://example.com/js/dist/editor.js',
				Mockery::type( 'array' ),
				'1.2.3'
			);

		$block_extend = new Router( $plugin );
		$block_extend->enqueue_editor_assets();
	}
}
