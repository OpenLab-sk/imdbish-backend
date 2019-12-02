<?php namespace Jules\Movies\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Movies Back-end Controller
 */
class Movies extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Jules.Movies', 'movies', 'movies');
    }
}
