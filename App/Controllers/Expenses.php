<?php

namespace App\Controllers;

use \Core\View;
use \App\Flash;
use \App\Models\MoneyRotation;
use \App\Auth;

/**
 * Expenses controller (example)
 *
 * PHP version 7.0
 */
//class Expenses extends \Core\Controller
class Expenses extends Authenticated
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
        View::renderTemplate('Expenses/new.html');
    }

    /**
     * Add expense
     *
     * @return void
     */
    public function addExpenseAction()
    {
        $moneyRotation = new MoneyRotation($_POST);
        
        if ($moneyRotation->addExpenseAmount()) {

            Flash::addMessage('Wydatek dodano');

            $this->redirect('/expenses/new');
           

        } else {
            Flash::addMessage('Niepowodzenie! Spróbuj ponownie dodać wydatek');

            View::renderTemplate('Expenses/new.html');

        }
    }
}
