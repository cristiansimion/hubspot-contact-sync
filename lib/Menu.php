<?php
namespace CristianSimion\Lib;


class Menu
{
	/**
	 * Menu constructor.
	 */
	function __construct()
	{
		add_action('plugins_loaded', array($this, 'enqueue'));
	}

	/**
	 * Enqueue the menus
	 */
	function enqueue()
	{
		add_action( 'admin_menu', array( $this, 'menus' ) );
	}

	/**
	 * Add menus and submenus
	 */
	function menus()
	{
		add_menu_page( 'HS Dashboard', "Hubspot", 'manage_options', 'cristian-hubspot-settings', false, false, '0.01' );
		add_submenu_page( 'cristian-hubspot', 'HubSpot', 'HubSpot Settings', 'manage_options', 'cristian-hubspot-settings', [ $this, 'hubspot_settings_template' ], 4 );
	}

	/**
	 * Include template for the WP-Admin section
	 */
	function hubspot_settings_template() {
		require_once __DIR__ . '/../template/admin-settings-template.php';
	}
}