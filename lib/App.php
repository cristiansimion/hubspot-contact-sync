<?php

namespace CristianSimion\Lib;


class App
{
	function __construct()
	{
		$enqueue_scripts = new EnqueueScripts();
		$hubspot_wrapper = new HubSpotWrapper();
		$menu = new Menu();

		$woocommmerce = new WooCommerce();
	}
}