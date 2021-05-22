<?php
namespace CristianSimion\Lib;


class WooCommerce
{
	function __construct()
	{
		add_filter('user_register', [$this, 'user_registration']);
		add_action('hs_register_user_hook', [$this, 'register_hook'], 10, 2);
	}

	function register_hook( $user, $properties )
	{
		// Create/update the user contact
		HubSpotWrapper::create_or_update(
			$user->user_email,
			$properties
		);
	}

	function user_registration( $user_id )
	{
		$user = new \WP_User($user_id);

		// Property => field_name
		$fields = [
			'firstname' => 'first_name',
			'lastname' => 'last_name'
		];

		// User Custom Meta Fields Filter
		$fields = apply_filters('hs_get_user_meta_fields', $fields);

		$properties = [];
		foreach($fields as $property => $field) {
			$properties[$property] = get_user_meta($user_id, $field, true);
		}

		// Custom property values filter
		$properties = apply_filters('hs_get_user_customfields', $properties);

		// Hook for creating/updating users
		do_action('hs_register_user_hook', $user, $properties);
	}
}