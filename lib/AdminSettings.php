<?php
namespace CristianSimion\Lib;


class AdminSettings
{
	static function parse_submissions($post) {
		if(!isset($post['action']) || $post['action'] !== 'update_hubspot_key') return null;

		if ( ! wp_verify_nonce( $post['nonce'], 'cristiansimion_hubspot_key_nonce' ) ) {
			echo 'Invalid nonce detected. Busted.';
			return;
		}

		update_option(API_KEY_OPTION_NAME, sanitize_text_field($post['api_key']));
		echo '<div class="alert alert-success">Updated the api key successfully</div>';
	}
}