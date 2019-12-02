<?php

namespace Jules\Movies;

use Backend;
use System\Classes\PluginBase;

/**
 * movies Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'movies',
            'description' => 'No description provided yet...',
            'author'      => 'jules',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    { }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    { }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Jules\Movies\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'jules.movies.some_permission' => [
                'tab' => 'movies',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        // return []; // Remove this line to activate

        return [
            'movies' => [
                'label'       => 'movies',
                'url'         => Backend::url('jules/movies/movies'),
                'icon'        => 'icon-leaf',
                'permissions' => ['jules.movies.*'],
                'order'       => 500,
            ],
        ];
    }
}
