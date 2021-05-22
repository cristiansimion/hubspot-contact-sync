<?php
/**
 * Plugin name: HubSpot Sync Wrapper
 * Description: Hook-able HubSpot Integration plus WooCommerce customer registration integration.
 * Author: Cristian Simion
 * Author URI: https://cristiansimion.com
 * Version: 1.0.0
 */

/** Autoload Functionality */
require_once 'autoload.php';
define('CODEABLE_HUBSPOT_FILE', __FILE__ );
define('CODEABLE_HUBSPOT_DIR', __DIR__ );
define('CODEABLE_HUBSPOT_KEY', '');

define('API_KEY_OPTION_NAME', '_hubspot_hapi_key');
define('IS_DEV_ONLY', true);

$app = new \CristianSimion\Lib\App();