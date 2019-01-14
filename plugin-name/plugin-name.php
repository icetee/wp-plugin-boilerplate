<?php

declare(strict_types=1);

use PluginCreator\PluginName\Activator;
use PluginCreator\PluginName\Deactivator;
use PluginCreator\PluginName\PluginName;

/*
 * @wordpress-plugin
 * Plugin Name:       WordPress Plugin Boilerplate
 * Plugin URI:        http://example.com/plugin-name-uri/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Your Name or Your Company
 * Author URI:        http://example.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       plugin-name
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (! defined('WPINC')) {
    return;
}

/**
 * Include composer autoloader
 */
require 'vendor/autoload.php';

/**
 * The code that runs during plugin activation.
 */
register_activation_hook(__FILE__, Activator::activate());

/**
 * The code that runs during plugin deactivation.
 */
register_activation_hook(__FILE__, Deactivator::deactivate());

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and client-facing site hooks.
 */
(new PluginName('1.0.0'))->run();
