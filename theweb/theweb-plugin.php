<?php

/**
 * @package theweb_plugin
 * Plugin Name:       The Web Plugin
 * Plugin URI:        
 * Description:       Create and handle survey.
 * Version:           1.0.0
 * Author:            Marble Hornets
 */

defined('ABSPATH') or die();

define('PLUGIN_DIR_BASENAME', plugin_dir_path(__FILE__));
define('PLUGIN_URL', plugins_url('/theweb'));
define('PLUGIN_BASENAME', plugin_basename(__FILE__));

if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once(dirname(__FILE__) . '/vendor/autoload.php');
};

register_activation_hook(__FILE__, ['TheWeb\Common\Activate', 'activate']);
register_deactivation_hook(__FILE__, ['TheWeb\Common\Deactivate', 'deactivate']);
register_uninstall_hook(__FILE__, ['TheWeb\Common\Uninstall', 'uninstall']);

if (class_exists('TheWeb\\Initialize')) {
    TheWeb\Initialize::register();
};
