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
     * Require the user to be authenticated before giving access to all methods in the controller
     *
     * @return void
     */
    /*
    protected function before()
    {
        $this->requireLogin();
    }
    */

    /**
     * Expenses index
     *
     * @return void
     */
    public function indexAction()
    {
        View::renderTemplate('Expenses/index.html');
    }

    /**
     * Add a new item
     *
     * @return void
     */
    public function newAction()
    {
        echo "new action";
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
