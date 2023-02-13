<?php

namespace App\Controllers;

use \Core\View;
use \App\Flash;
use \App\Models\MoneyRotation;
use \App\Auth;


/**
 * Balance controller (example)
 *
 * PHP version 7.0
 */
//class Balance extends \Core\Controller
class Balance extends Authenticated
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
        View::renderTemplate('Balance/new.html');
    }

    /**
     * Show an item
     *
     * @return void
     */
    public function showAction()
    {
        $moneyRotation = MoneyRotation::findTimePeriode($_POST['selectTimePeriode']);
        //$moneyRotation = MoneyRotation::findTimePeriode($_POST['selectTimePeriode']);
        $allUserIncomes = MoneyRotation::getAllUserIncomes();
        //var_dump($allUserIncomes);

        if ($moneyRotation) {

           View::renderTemplate('Balance/show.html',[
            'moneyRotation' => $moneyRotation,
            'allUserIncomes' => $allUserIncomes
         ]);
           

       // } else {
            //Flash::addMessage('Niepowodzenie! Spróbuj ponownie wyświetlić bilas');

          //  $this->redirect('/balance/new');

      }
    }
}
