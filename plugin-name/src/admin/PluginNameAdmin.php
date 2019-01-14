<?php

declare(strict_types=1);

namespace PluginCreator\PluginName\Admin;

class PluginNameAdmin
{
    /**
     * The ID of this plugin.
     *
     * @access   private
     * @var      string    $pluginName    The ID of this plugin.
     */
    private $pluginName;

    /**
     * The version of this plugin.
     *
     * @access   private
     * @var      string    $version    The current version of this plugin.
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
     * Register the stylesheets for the admin-facing side of the site.
     */
    public function enqueueStyles()
    {
        $cssPath = plugin_dir_url(__FILE__) . 'css/';

        wp_enqueue_style($this->pluginName, $cssPath . 'plugin-name-admin.css', [], $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin-facing side of the site.
     */
    public function enqueueScripts()
    {
        $jsPath = plugin_dir_url(__FILE__) . 'js/';

        wp_enqueue_script($this->pluginName, $jsPath . 'plugin-name-admin.js', ['jquery'], $this->version, false);
    }
}
