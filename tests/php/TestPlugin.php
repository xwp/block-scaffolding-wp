<?php
/**
 * Tests for Plugin class.
 *
 * @package BlockExtend
 */

namespace XWP\BlockExtend;

use Mockery;
use WP_Mock;

/**
 * Test the WordPress plugin abstraction.
 */
class TestPlugin extends WP_Mock\Tools\TestCase {

	use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

	/**
	 * Test the plugin setup.
	 *
	 * @covers \XWP\BlockExtend\Plugin::__construct()
	 * @covers \XWP\BlockExtend\Plugin::file()
	 * @covers \XWP\BlockExtend\Plugin::dir()
	 */
	public function test_plugin_init() {
		WP_Mock::userFunction( 'wp_upload_dir' )
			->once()
			->with( null, false );

		$plugin = new Plugin( '/absolute/path/to/plugin.php' );

		$this->assertEquals( '/absolute/path/to/plugin.php', $plugin->file() );
		$this->assertEquals( '/absolute/path/to', $plugin->dir() );
	}

	/**
	 * Test the plugin setup.
	 *
	 * @covers \XWP\BlockExtend\Plugin::basename()
	 */
	public function test_basename() {
		// Is there a way to do this using withArgs() and andReturnValues()?
		$mock = WP_Mock::userFunction( 'plugin_basename' )->twice();

		$mock->with( '/any/random/file.js' )->andReturn( 'plugins/any/random/file.js' );

		$plugin = new Plugin( '/path/to/plugin/file.php' );

		$this->assertEquals(
			'plugins/any/random/file.js',
			$plugin->basename( '/any/random/file.js' ),
			'Asks WP API to return the basename for a file'
		);

		$mock->with( '/path/to/plugin/file.php' )->andReturn( 'plugins/plugin/file.php' );

		$this->assertEquals(
			'plugins/plugin/file.php',
			$plugin->basename(),
			'Defaults to the main plugin file for the basename'
		);
	}

}
