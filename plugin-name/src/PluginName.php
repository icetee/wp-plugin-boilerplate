<?php

declare(strict_types=1);

namespace PluginCreator\PluginName;

use PluginCreator\PluginName\Admin\PluginNameAdmin;
use PluginCreator\PluginName\Client\PluginNameClient;

class PluginName
{
    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @access   protected
     * @var      Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @access   protected
     * @var      string    $pluginName    The string used to uniquely identify this plugin.
     */
    protected $pluginName;

    /**
     * Unique identifier for retrieving translated strings.
     *
     * @access   protected
     * @var      string    $domain    Unique identifier for retrieving translated strings.
     */
    protected $domain;

    /**
     * The current version of the plugin.
     *
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the client-facing side of the site.
     */
    public function __construct(
        $version = '1.0.0',
        $pluginName = 'plugin-name',
        $domain = 'plugin-name'
    ) {
        $this->version    = $version;
        $this->pluginName = $pluginName;
        $this->domain     = $domain;

        $this->loadDependencies();
        $this->setLocale();
        $this->defineAdminHooks();
        $this->defineClientHooks();
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Loader. Orchestrates the hooks of the plugin.
     * - I18n. Defines internationalization functionality.
     * - PluginNameAdmin. Defines all hooks for the admin area.
     * - PluginNameClient. Defines all hooks for the client side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @access   private
     */
    private function loadDependencies()
    {
        $this->loader = new Loader();
    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the pluginName_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @access   private
     */
    private function setLocale()
    {
        $i18n = new I18n($this->getDomain());

        $this->loader->addAction('plugins_loaded', $i18n, 'load_plugin_textdomain');
    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @access   private
     */
    private function defineAdminHooks()
    {
        $admin = new PluginNameAdmin($this->getPluginName(), $this->getVersion());

        $this->loader->addAction('admin_enqueue_scripts', $admin, 'enqueue_styles');
        $this->loader->addAction('admin_enqueue_scripts', $admin, 'enqueue_scripts');
    }

    /**
     * Register all of the hooks related to the client-facing functionality
     * of the plugin.
     *
     * @access   private
     */
    private function defineClientHooks()
    {
        $client = new PluginNameClient($this->getPluginName(), $this->getVersion());

        $this->loader->addAction('wp_enqueue_scripts', $client, 'enqueue_styles');
        $this->loader->addAction('wp_enqueue_scripts', $client, 'enqueue_scripts');
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     */
    public function run()
    {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @return    string    The name of the plugin.
     */
    public function getPluginName()
    {
        return $this->pluginName;
    }

    /**
     * Unique identifier for retrieving translated strings.
     *
     * @return    string    $domain    Unique identifier for retrieving translated strings.
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @return    Loader    Orchestrates the hooks of the plugin.
     */
    public function getLoader()
    {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @return    string    The version number of the plugin.
     */
    public function getVersion()
    {
        return $this->version;
    }
}
