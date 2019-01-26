<?php

declare(strict_types=1);

namespace PluginCreator\PluginName;

use WP_CLI;
use WP_CLI_Command;

use function class_exists;

class Loader
{
    /**
     * The array of actions registered with WordPress.
     *
     * @access protected
     * @var    array     $actions The actions registered with WordPress to fire when the plugin loads.
     */
    protected $actions;

    /**
     * The array of filters registered with WordPress.
     *
     * @access protected
     * @var    array     $filters The filters registered with WordPress to fire when the plugin loads.
     */
    protected $filters;

    /**
     * The array of shortcodes registered with WordPress.
     *
     * @access protected
     * @var    array     $shortcodes The shortcodes registered with WordPress to fire when the plugin loads.
     */
    protected $shortcodes;

    /**
     * Initialize the collections used to maintain the actions and filters.
     */
    public function __construct()
    {
        $this->actions    = [];
        $this->filters    = [];
        $this->shortcodes = [];
    }

    /**
     * Add a new action to the collection to be registered with WordPress.
     *
     * @param string $hook         The name of the WordPress action that is being registered.
     * @param object $component    A reference to the instance of the object on which the action is defined.
     * @param string $callback     The name of the function definition on the $component.
     * @param int    $priority     Optional. The priority at which the function should be fired.
     * @param int    $acceptedArgs Optional. The number of arguments that should be passed to the $callback.
     */
    public function addAction($hook, $component, $callback, $priority = 10, $acceptedArgs = 1)
    {
        $this->actions = $this->add($this->actions, $hook, $component, $callback, $priority, $acceptedArgs);
    }

    /**
     * Add a new filter to the collection to be registered with WordPress.
     *
     * @param string $hook         The name of the WordPress action that is being registered.
     * @param object $component    A reference to the instance of the object on which the action is defined.
     * @param string $callback     The name of the function definition on the $component.
     * @param int    $priority     Optional. The priority at which the function should be fired.
     * @param int    $acceptedArgs Optional. The number of arguments that should be passed to the $callback.
     */
    public function addFilter($hook, $component, $callback, $priority = 10, $acceptedArgs = 1)
    {
        $this->filters = $this->add($this->filters, $hook, $component, $callback, $priority, $acceptedArgs);
    }

    /**
     * Add a new shortcode to the collection to be registered with WordPress
     *
     * @param string $tag       The name of the new shortcode.
     * @param object $component A reference to the instance of the object on which the shortcode is defined.
     * @param string $callback  The name of the function that defines the shortcode.
     */
    public function add_shortcode($tag, $component, $callback, $priority = 10, $acceptedArgs = 1)
    {
        $this->shortcodes = $this->add($this->shortcodes, $tag, $component, $callback, $priority, $acceptedArgs);
    }

    public function addCliCommand($pluginName, WP_CLI_Command $command)
    {
        if (! class_exists('WP_CLI')) {
            return;
        }

        WP_CLI::add_command($pluginName, $command);
    }

    /**
     * A utility function that is used to register the actions and hooks into a single
     * collection.
     *
     * @access private
     * @param  array  $hooks        The collection of hooks that is being registered (that is, actions or filters).
     * @param  string $hook         The name of the WordPress filter that is being registered.
     * @param  object $component    A reference to the instance of the object on which the filter is defined.
     * @param  string $callback     The name of the function definition on the $component.
     * @param  int    $priority     The priority at which the function should be fired.
     * @param  int    $acceptedArgs The number of arguments that should be passed to the $callback.
     *
     * @return array  The collection of actions and filters registered with WordPress.
     */
    private function add($hooks, $hook, $component, $callback, $priority, $acceptedArgs)
    {
        $hooks[] = [
            'hook'          => $hook,
            'component'     => $component,
            'callback'      => $callback,
            'priority'      => $priority,
            'accepted_args' => $acceptedArgs,
        ];

        return $hooks;
    }

    /**
     * Register the filters and actions with WordPress.
     */
    public function run()
    {
        foreach ($this->filters as $hook) {
            $function = [$hook['component'], $hook['callback']];

            add_filter($hook['hook'], $function, $hook['priority'], $hook['accepted_args']);
        }

        foreach ($this->actions as $hook) {
            $function = [$hook['component'], $hook['callback']];

            add_action($hook['hook'], $function, $hook['priority'], $hook['accepted_args']);
        }

        foreach ($this->shortcodes as $hook) {
            add_shortcode($hook['hook'], [$hook['component'], $hook['callback']]);
        }
    }
}
