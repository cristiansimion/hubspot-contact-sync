<?php
namespace CristianSimion\Lib;


class EnqueueScripts
{
	/**
	 * EnqueueScripts constructor.
	 */
	function __construct()
	{
		add_action('admin_enqueue_scripts', [ $this, 'scripts' ] );
		add_action('wp_enqueue_scripts',  [ $this, 'scripts' ] );
	}

	/**
	 * Static function to enqueues scripts and styles
	 */
	static function enqueue_scripts_and_styles() {
		wp_enqueue_style('bootstrap-4-min');
		wp_enqueue_style('bootstrap-4-grid');
		wp_enqueue_style('bootstrap-4-reboot');
		wp_enqueue_style('bootstrap-4-toggle-css');
		wp_enqueue_style('bootstrap-4-icons');
		wp_enqueue_style('cristiansimion-hubspot-custom-css');

		wp_enqueue_script('bootstrap-min-js');
		wp_enqueue_script('bootstrap-toggle-js');
	}

	/**
	 * Register scripts & styles
	 */
	function scripts()
	{
		wp_register_style("bootstrap-4-min", plugins_url("css/bootstrap4.min.css", CODEABLE_HUBSPOT_FILE));
		wp_register_style("bootstrap-4-grid", plugins_url("css/bootstrap4-grid.min.css", CODEABLE_HUBSPOT_FILE));
		wp_register_style("bootstrap-4-reboot", plugins_url("css/bootstrap4-reboot.min.css", CODEABLE_HUBSPOT_FILE));
		wp_register_style("bootstrap-4-toggle-css", plugins_url("css/bootstrap-toggle.min.css", CODEABLE_HUBSPOT_FILE));
		wp_register_style("bootstrap-4-icons", plugins_url("icons/bootstrap-icons.css", CODEABLE_HUBSPOT_FILE));
		wp_register_style("cristiansimion-hubspot-custom-css", plugins_url("css/hub.spot.custom.css", CODEABLE_HUBSPOT_FILE));

		wp_register_script( 'bootstrap-min-js', plugins_url( 'js/bootstrap.min.js', CODEABLE_HUBSPOT_FILE ) , ['jquery'], '1.0.0', true );
		wp_register_script( 'bootstrap-toggle-js', plugins_url( 'js/bootstrap-toggle.min.js', CODEABLE_HUBSPOT_FILE ) , ['jquery'], '1.0.0', true );
	}
}