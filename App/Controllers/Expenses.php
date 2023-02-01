<?php

namespace App\Controllers;

use \Core\View;

/**
 * Expenses controller (example)
 *
 * PHP version 7.0
 */
//class Expenses extends \Core\Controller
class Expenses extends Authenticated
{

    /**
     * Expenses index
     *
     * @return void
     */
    public function indexAction()
    {
        echo "new action";
    }

    /**
     * Add a new item
     *
     * @return void
     */
    public function newAction()
    {       
        View::renderTemplate('Expenses/new.html');
    }

    /**
     * Show an item
     *
     * @return void
     */
    public function showAction()
    {
        echo "show action";
    }
}
