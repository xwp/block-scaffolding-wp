<?php

namespace XWP\BlockExtend;

/**
 * Plugin Router.
 */
class BlockExtendPlugin {

	/**
	 * Plugin interface.
	 *
	 * @var XWP\BlockExtend\Plugin
	 */
	protected $plugin;

	/**
	 * Setup the plugin instance.
	 *
	 * @param XWP\BlockExtend\Plugin $plugin Instance of the plugin abstraction.
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;
	}

	/**
	 * Hook into WP.
	 *
	 * @return void
	 */
	public function init() {
		add_action( 'enqueue_block_editor_assets', [ $this, 'enqueue_editor_assets' ] );
	}

	/**
	 * Load our block assets.
	 *
	 * @return void
	 */
	public function enqueue_editor_assets() {
		wp_enqueue_script(
			'xwp-block-exend-js',
			$this->plugin->asset_url( 'js/dist/editor.js' ),
			[
				'lodash',
			],
			$this->plugin->asset_version()
		);
	}
}
