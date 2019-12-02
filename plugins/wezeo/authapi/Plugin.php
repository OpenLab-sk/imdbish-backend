<?php namespace Wezeo\Authapi;

use Backend;
use System\Classes\PluginBase;

/**
 * authapi Plugin Information File
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
            'name'        => 'authapi',
            'description' => 'WEZEO: Zakladne AUTH API volania pre vsetky Ionic appky',
            'author'      => 'wezeo',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

    }

}
