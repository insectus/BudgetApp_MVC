<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;

/**
 * Incomes controller (example)
 *
 * PHP version 7.0
 */
//class Incomes extends \Core\Controller
class Incomes extends Authenticated
{

    /**
     * Require the user to be authenticated before giving access to all methods in the controller
     *
     * @return void
     */
    /*
    /**
     * Before filter - called before each action method
     *
     * @return void
     */
	protected function before()
    {
        parent::before();

        $this->user = Auth::getUser();
    }

    /**
     * Incomes index
     *
     * @return void
     */
    public function indexAction()
    {
        View::renderTemplate('Incomes/index.html', [
            'user' => $this->user
        ]);
    }
}
