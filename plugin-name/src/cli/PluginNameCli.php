<?php

declare(strict_types=1);

namespace PluginCreator\PluginName\Cli;

use WP_CLI;
use WP_CLI_Command;

class PluginNameCli extends WP_CLI_Command
{
    /**
     * The ID of this plugin.
     *
     * @access private
     * @var    string  $pluginName The ID of this plugin.
     */
    private $pluginName;

    /**
     * The version of this plugin.
     *
     * @access private
     * @var    string  $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $pluginName The name of the plugin.
     * @param string $version    The version of this plugin.
     */
    public function __construct($pluginName, $version)
    {
        $this->pluginName = $pluginName;
        $this->version    = $version;
    }

    /**
     * Example Hello Plugin Name custom WP-CLI command
     *
     * @param array $args      Command arguments array.
     * @param array $assocArgs Associated arguments array.
     */
    public function hello($args, $assocArgs) {
        WP_CLI::log('Hello ' . $this->pluginName);
    }
}
