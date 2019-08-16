<?php
/**
 * Tests for class BlockExtendPlugin.
 */

namespace XWP\BlockExtendTest;

use WP_Mock;
use Mockery;
use XWP\BlockExtend\BlockExtendPlugin;
use XWP\BlockExtend\Plugin;

/**
 * Tests for class BlockExtendPlugin.
 */
class BlockExtendPluginTest extends BlockExtendTestCase {

	/**
	 * Test init.
	 *
	 * @covers XWP\BlockExtend\BlockExtendPlugin::init()
	 */
	public function test_init() {
		$plugin = new BlockExtendPlugin( Mockery::mock( Plugin::class ) );

		WP_Mock::expectActionAdded( 'enqueue_block_editor_assets', [ $plugin, 'enqueue_editor_assets' ], 10, 1 );

		$plugin->init();
	}

	/**
	 * Test enqueue_editor_assets.
	 *
	 * @covers XWP\BlockExtend\BlockExtendPlugin::enqueue_editor_assets()
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
				'xwp-block-extend-js',
				'http://example.com/js/dist/editor.js',
				Mockery::type( 'array' ),
				'1.2.3'
			);

		$block_extend = new BlockExtendPlugin( $plugin );
		$block_extend->enqueue_editor_assets();
	}
}
