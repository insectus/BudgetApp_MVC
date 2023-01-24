<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Home extends \Core\Controller
{
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
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        View::renderTemplate('Home/index.html', [
            'user' => $this->user
        ]);
    }
}