<?php

namespace CristianSimion\Lib;

class HubSpotWrapper
{
	public static $api_url = 'https://api.hubapi.com';
	public static $api_key = null;

	public static $contact_endpoint = '/crm/v3/objects/contacts';
	public static $contact_search_endpoint = '/crm/v3/objects/contacts/search';

	function __construct()
	{
		// Configure the default object
		self::configure();
	}

	/**
	 * Get the key and set it the object
	 */
	static function configure()
	{
		self::$api_key = self::get_api_key();
	}

	/**
	 * Get the API Key from the wordpress options
	 * @return string: The HubSpot Key
	 */
	static function get_api_key()
	{
		$option = get_option(API_KEY_OPTION_NAME);
		if ($option) return $option;

		return CODEABLE_HUBSPOT_KEY;
	}

	/**
	 * Search and return a hubspot contact by email
	 * @param $email : String email
	 * @param $debug: true if you want to show the error responses
	 * @return bool|array: JSON response with contact details
	 */
	static function get_contact($email, $debug=false)
	{
		$endpoint = self::$api_url . self::$contact_search_endpoint;

		if (!self::$api_key) {
			self::configure();
		}

		$data = json_encode([
			'filterGroups' => [
				[
					'filters' => [
						[
							'value' => $email,
							'propertyName' => 'email',
							'operator' => 'EQ'
						]
					],
				]
			]
		]);

		$response = self::request($endpoint, $data, 'POST');
		$arr_response = json_decode($response, true);

		if(isset($arr_response['status']) && $arr_response['status'] === 'error') {
			if($debug) {
				return $arr_response;
			}

			return false;
		}
		if(!count($arr_response['results'])) {
			return null;
		}

		return $arr_response['results'][0];
	}


	/**
	 * Create a new hubspot contact using email & properties or update an existing one
	 * @param $email
	 * @param $properties
	 * @return array|bool
	 */
	static function create_or_update($email, $properties)
	{
		$contact = self::get_contact($email);
		if(!isset($contact['id'])) {
			return self::create_contact($email, $properties);
		}

		return self::update_contact($contact['id'], $properties);
	}

	/**
	 *
	 * @param $email: Email as string
	 * @param array $properties: properties as [property=>value]
	 * @param $debug: true if you want to show the error responses
	 * @return bool|array
	 */
	static function create_contact($email, $properties, $debug=false)
	{
		$endpoint = self::$api_url . self::$contact_endpoint;
		$properties['email'] = $email;

		$data = json_encode([
			'properties' => $properties
		]);

		$response = self::request($endpoint, $data, 'POST');
		$arr_response = json_decode($response, true);

		if(isset($arr_response['status']) && $arr_response['status'] === 'error') {
			if($debug) {
				return $arr_response;
			}

			return false;
		}

		return $arr_response;

	}


	/**
	 * @param $contact_id : contactId from hubspot. Can be retried from get_contact
	 * @param $properties : Array of properties [ property => value, property => value, etc... ]
	 * @param $debug: true if you want to show the error responses
	 * @return bool|array: JSON response with updated contact
	 */
	static function update_contact($contact_id, $properties, $debug=false)
	{
		$endpoint = self::$api_url . self::$contact_endpoint . '/' . $contact_id;

		if (!self::$api_key) {
			self::configure();
		}
		$data = json_encode([
			'properties' => $properties
		]);

		$response = self::request($endpoint, $data, 'PATCH');
		$arr_response = json_decode($response, true);

		if(isset($arr_response['status']) && $arr_response['status'] === 'error') {
			if($debug) {
				return $arr_response;
			}

			return false;
		}

		return $arr_response;
	}

	/**
	 * @param $endpoint : Full endpoint for the call
	 * @param null|string $data : JSON string expected in most cases
	 * @param string $method : GET | POST (NEW) | DELETE (ARCHIVE) | PATCH (UPDATE)
	 * @return string: JSON string response
	 */
	static function request($endpoint, $data = null, $method = 'GET')
	{
		// Format request to include the Hubspot Api Key
		$api_key = self::get_api_key();
		$endpoint = add_query_arg('hapikey', $api_key, $endpoint);

		$args = [
			'method' => $method,
			'headers' => [
				"accept: application/json",
				'Authorization' => 'Bearer ' . $api_key,
				'Content-Type' => 'application/json',
			],
			'body' => $data,
			'sslverify' => !IS_DEV_ONLY,
		];

		$response = wp_remote_request($endpoint, $args);
		return wp_remote_retrieve_body($response);
	}
}