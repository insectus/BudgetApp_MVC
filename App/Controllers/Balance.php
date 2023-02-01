<?php

namespace App\Controllers;

use \Core\View;

/**
 * Balance controller (example)
 *
 * PHP version 7.0
 */
//class Balance extends \Core\Controller
class Balance extends Authenticated
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
     * Balance index
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
        View::renderTemplate('Balance/new.html');
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
