<?php

namespace App\Controllers;

use \Core\View;
use \App\Flash;
use \App\Models\MoneyRotation;
use \App\Auth;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;
use function Symfony\Component\Serializer\Encoder\json_encode;

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
        $allUserIncomes = MoneyRotation::getAllUserIncomes($_POST['selectTimePeriode']);
        $allSalary = MoneyRotation::getSalary($_POST['selectTimePeriode']);
        $allIntrest = MoneyRotation::getIntrest($_POST['selectTimePeriode']);
        $allAllegro = MoneyRotation::getAllegro($_POST['selectTimePeriode']);
        $allAnother = MoneyRotation::getAnother($_POST['selectTimePeriode']);
        //var_dump($allSalary);
        $allUserExpenses = MoneyRotation::getAllUserExpense($_POST['selectTimePeriode']);
        $allTransport = MoneyRotation::getTransport($_POST['selectTimePeriode']);
        $allBooks = MoneyRotation::getBooks($_POST['selectTimePeriode']);
        $allFood = MoneyRotation::getFood($_POST['selectTimePeriode']);
        $allApart = MoneyRotation::getApart($_POST['selectTimePeriode']);
        $allTelec = MoneyRotation::getTelec($_POST['selectTimePeriode']);
        $allHealth = MoneyRotation::getHealth($_POST['selectTimePeriode']);
        $allClothes = MoneyRotation::getClothes($_POST['selectTimePeriode']);
        $allHygen = MoneyRotation::getHygen($_POST['selectTimePeriode']);
        $allKids = MoneyRotation::getKids($_POST['selectTimePeriode']);
        $allRecreat = MoneyRotation::getRecreat($_POST['selectTimePeriode']);
        $allTrip = MoneyRotation::getTrip($_POST['selectTimePeriode']);
        $allSavin = MoneyRotation::getSavin($_POST['selectTimePeriode']);
        $allReti = MoneyRotation::getReti($_POST['selectTimePeriode']);
        $allDebt = MoneyRotation::getDebt($_POST['selectTimePeriode']);
        $allGift = MoneyRotation::getGift($_POST['selectTimePeriode']);
        $allAnoth = MoneyRotation::getAnoth($_POST['selectTimePeriode']);
        $allRecreat = MoneyRotation::getRecreat($_POST['selectTimePeriode']);

        if ($allUserIncomes) {
           View::renderTemplate('Balance/show.html',[
            'allUserIncomes' => $allUserIncomes,
            'allSalary' => $allSalary,
            'allIntrest' => $allIntrest,
            'allAllegro' => $allAllegro,
            'allAnother' => $allAnother,
            'allUserExpenses' => $allUserExpenses,
            'allTransport' => $allTransport,
            'allBooks' => $allBooks,
            'allFood' => $allFood,
            'allApart' => $allApart,
            'allTelec' => $allTelec,
            'allHealth' => $allHealth,
            'allClothes' => $allClothes,
            'allHygen' => $allHygen,
            'allKids' => $allKids,
            'allRecreat' => $allRecreat,
            'allTrip' => $allTrip,
            'allSavin' => $allSavin,
            'allReti' => $allReti,
            'allDebt' => $allDebt,
            'allGift' => $allGift,
            'allAnoth' => $allAnoth,
            'allRecreat' => $allRecreat,
         ]);    
       } else {
            Flash::addMessage('Niepowodzenie! Spróbuj ponownie wyświetlić bilas');

            $this->redirect('/balance/new');

      }
    }

}


