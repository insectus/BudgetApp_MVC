<?php

namespace App\Controllers;

use \Core\View;
use \App\Flash;

class Incomes extends Authenticated
{
    /**
     * Incomes index
     *
     * @return void
     */
    public function indexAction()
    {
        echo "index Action";
    }

    /**
     * Add a new item
     *
     * @return void
     */
    public function newAction()
    {       
        View::renderTemplate('Incomes/new.html');
    }

    public function addAction()
    {

        if (1==1) {

            Flash::addMessage('Przychód dodano');

            $this->redirect('/incomes/new');

        } else {
            Flash::addMessage('Niepowodzenie! Spróbuj ponownie dodać przychód');

            View::renderTemplate('Incomes/new.html');

        }
    }
}
