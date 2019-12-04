<?php
/**
 * Tests for class BlockPluginTemplatePlugin.
 */

namespace XWP\BlockPluginTemplateTest;

use WP_Mock;
use Mockery;
use XWP\BlockPluginTemplate\BlockPluginTemplatePlugin;
use XWP\BlockPluginTemplate\Plugin;

/**
 * Tests for class BlockPluginTemplatePlugin.
 */
class BlockPluginTemplatePluginTest extends BlockPluginTemplateTestCase {

	/**
	 * Test init.
	 *
	 * @covers XWP\BlockPluginTemplate\BlockPluginTemplatePlugin::init()
	 */
	public function test_init() {
		$plugin = new BlockPluginTemplatePlugin( Mockery::mock( Plugin::class ) );

		WP_Mock::expectActionAdded( 'enqueue_block_editor_assets', [ $plugin, 'enqueue_editor_assets' ], 10, 1 );

		$plugin->init();
	}

	/**
	 * Test enqueue_editor_assets.
	 *
	 * @covers XWP\BlockPluginTemplate\BlockPluginTemplatePlugin::enqueue_editor_assets()
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
				'xwp-block-plugin-template-js',
				'http://example.com/js/dist/editor.js',
				Mockery::type( 'array' ),
				'1.2.3'
			);

		$block_extend = new BlockPluginTemplatePlugin( $plugin );
		$block_extend->enqueue_editor_assets();
	}
}
