<?php

namespace App\Controllers;

use \Core\View;
use \App\Flash;
use \App\Models\MoneyRotation;

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
        $moneyRotation = new MoneyRotation($_POST);

        if ($moneyRotation->addAmount()) {

            Flash::addMessage('Przychód dodano');

            $this->redirect('/incomes/new');

        } else {
            Flash::addMessage('Niepowodzenie! Spróbuj ponownie dodać przychód');

            View::renderTemplate('Incomes/new.html');

        }
    }
}
