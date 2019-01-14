<?php

declare(strict_types=1);

namespace PluginCreator\PluginName;

use function dirname;

class I18n
{
    /**
     * Unique identifier for retrieving translated strings.
     *
     * @access   protected
     * @var      string    $domain    Unique identifier for retrieving translated strings.
     */
    protected $domain;

    /**
     * Initialize the text domain for i18n.
     *
     */
    public function __construct($domain)
    {
        $this->domain = $domain;
    }

    public function loadPluginTextdomain()
    {
        load_plugin_textdomain(
            $this->domain,
            false,
            dirname(plugin_basename(__FILE__), 2) . '/languages/'
        );
    }
}
