<?php

namespace App\Controllers;

use \Core\View;
use \App\Flash;
use \App\Models\MoneyRotation;
use \App\Auth;

class Incomes extends  Authenticated
{
    protected function before()
    {
        parent::before();

        $this->user = Auth::getUser();
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

    public function addIncomeAction()
    {
        $moneyRotation = new MoneyRotation($_POST);
        
        if ($moneyRotation->addIncomeAmount()) {

            Flash::addMessage('Przychód dodano');

            $this->redirect('/incomes/new');
           

        } else {
            Flash::addMessage('Niepowodzenie! Spróbuj ponownie dodać przychód');

            View::renderTemplate('Incomes/new.html');

        }
    }
}
