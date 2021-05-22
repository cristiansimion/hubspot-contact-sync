<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

spl_autoload_register(function ($class)
{
	if (preg_match('/^CristianSimion\\\\(.+)?([^\\\\]+)$/U', ltrim($class, '\\'), $match)) {
		$file = __DIR__ . DIRECTORY_SEPARATOR
			. strtolower(str_replace('\\', DIRECTORY_SEPARATOR, preg_replace('/([a-z])([A-Z])/', '$1_$2', $match[1])))
			. $match[2]
			. '.php';
		if (is_readable($file)) {
			require_once $file;
		}
	}
}, true, true);