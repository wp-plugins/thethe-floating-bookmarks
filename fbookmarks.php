<?php 
/*
Plugin Name: TheThe Floating Bookmarks
Plugin URI: http://www.thethefly.com
Description: A floating share box keeps those oh-so-important social media buttons - Facebook, Twitter, and Google+ - close at hand, no matter where users find themselves on the site.

Version: 1.0.0
Author: TheThe Fly
Author URI: http://www.thethefly.com
*/
/**
 * @version 	$Id: fbookmarks.php 990 2011-08-29 12:41:52Z lexx-ua $
 */
/**
 * Init classes,func and libs
 */
/** Require RSS lib */
require_once ABSPATH . WPINC . '/class-simplepie.php';
require_once ABSPATH . WPINC . '/class-feed.php';
require_once ABSPATH . WPINC . '/feed.php';
/** Require WP Plugin API */
require_once ABSPATH . '/wp-admin/includes/plugin.php';
require_once realpath(dirname(__FILE__) . '/lib/lib.core.php');
TheTheFly_require(dirname(__FILE__) . '/lib', array('func.','lib.'));
TheTheFly_require(dirname(__FILE__) . '/lib', array('class.','widget.'));

/**
 * Current plugin config
 * @var array
 */
$Plugin_Config = array(
	'shortname' => 'fbookmarks',
	'plugin-hook' => 'thethe-floating-bookmarks/fbookmarks.php',
	'options' => array(
		'default' => array(
			'position-align' => 'left',
			'position-indent' => '33',
			'bg-color' => '#fff',
			'border-width' => '1',
			'border-color' => '#333',
			'border-radius' => '3',
			'twitter-username' => null,
			'backLink' => 1
		),
		'style' => array(
			'custom-css' => 'div#social-float {} ' . chr(10)
		)
	),
	'requirements' => array('wp' => '3.1')
) + array('meta' => get_plugin_data(realpath(__FILE__)) + array(
	'wp_plugin_dir' => dirname(__FILE__),
	'wp_plugin_dir_url' => plugin_dir_url(__FILE__)
)) + array(
	'clubpanel' => array(),
	'adminpanel' => array('sidebar.donate' => true)
);

/**
 * @var PluginFbookmarks
 */
$GLOBALS['PluginFbookmarks'] = new PluginFbookmarks();

/**
 * Configure
 */
$GLOBALS['PluginFbookmarks']->configure($Plugin_Config);

/**
 * Init
 */
TheTheFly_require(dirname(__FILE__),array('init.'));
$GLOBALS['PluginFbookmarks']->init();

/** @todo fixme */
if (!function_exists('TheThe_makeAdminPage')) {
	function TheThe_makeAdminPage() {
		$GLOBALS['PluginFbookmarks']->displayAboutClub();
	}
}