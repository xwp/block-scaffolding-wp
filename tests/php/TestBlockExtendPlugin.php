<?php
/**
 * Tests for class BlockExtendPlugin.
 */

use XWP\BlockExtend;

/**
 * Tests for class BlockExtendPlugin.
 */
class TestBlockExtendPlugin extends \WP_UnitTestCase {

	/**
	 * The instance to test.
	 *
	 * @var BlockExtend\BlockExtendPlugin
	 */
	public $instance;

	/**
	 * Setup.
	 *
	 * @inheritdoc
	 */
	public function setUp() {
		parent::setUp();
		$this->instance = new BlockExtend\BlockExtendPlugin( new BlockExtend\Plugin( dirname( __FILE__ ) ) );
	}

	/**
	 * Test __construct.
	 *
	 * @covers XWP\BlockExtend\BlockExtendPlugin::__construct()
	 */
	public function test_construct() {
		$plugin_reflection = new ReflectionObject( $this->instance );
		$plugin_instance           = $plugin_reflection->getProperty( 'plugin' );
		$plugin_instance->setAccessible( true );
		$plugin_made_accesible = $plugin_instance->getValue( $this->instance );

		// The $plugin property should be of the right class.
		$this->assertEquals( 'XWP\BlockExtend\Plugin', get_class( $plugin_made_accesible ) );
	}

	/**
	 * Test init.
	 *
	 * @covers XWP\BlockExtend\BlockExtendPlugin::init()
	 */
	public function test_init() {
		$this->instance->init();
		$this->assertEquals( 10, has_action( 'enqueue_block_editor_assets', [ $this->instance, 'enqueue_editor_assets' ] ) );
	}

	/**
	 * Test enqueue_editor_assets.
	 *
	 * @covers XWP\BlockExtend\BlockExtendPlugin::enqueue_editor_assets()
	 */
	public function test_enqueue_editor_assets() {
		$this->instance->enqueue_editor_assets();
		$expected_slug = 'xwp-block-extend-js';
		$scripts       = wp_scripts();
		$script        = $scripts->registered[ $expected_slug ];

		$this->assertTrue( in_array( $expected_slug, $scripts->queue, true ) );
		$this->assertEquals( $expected_slug, $script->handle );
		$this->assertContains( 'js/dist/editor.js', $script->src );
		$this->assertEquals(
			array(
				'lodash',
				'react',
				'wp-block-editor',
			),
			$script->deps
		);
		$this->assertEmpty( $script->extra );
	}
}
