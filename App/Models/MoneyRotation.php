<?php

namespace App\Models;

use PDO;
use \Core\View;
use \App\Auth;
use \Model\User;


/**
 * User model
 *
 * PHP version 7.0
 */
class MoneyRotation extends \Core\Model
{
     /**
     * Class constructor
     *
     * @param array $data  Initial property values (optional)
     *
     * @return void
     */
    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }

    

     /**
     * Save the income model with the current property values
     *
     * @return boolean  True if the income was saved, false otherwise
     */
    public function addIncomeAmount()
    {
        $sql = "INSERT INTO incomes 
        VALUES (NULL, :userId, :selectCategory, :currency_field, :date, :comment)";

            $db = static::getDB();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':userId',  $_SESSION['user_id'], PDO::PARAM_INT);
            $stmt->bindValue(':selectCategory', $this->selectCategory, PDO::PARAM_INT);
            $stmt->bindValue(':currency_field', $this->currency_field, PDO::PARAM_STR);
            $stmt->bindValue(':date', $this->date, PDO::PARAM_STR);
            $stmt->bindValue(':comment', $this->comment, PDO::PARAM_STR);

        return $stmt->execute();
    }
    /**
     * Save the expenses model with the current property values
     *
     * @return boolean  True if the expense was saved, false otherwise
     */
    public function addExpenseAmount()
    {

        $sql = 'INSERT INTO expenses
        VALUES (NULL, :userId, :selectCategory, 0, :currency_field, :date, :comment)';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':userId', $_SESSION['user_id'], PDO::PARAM_STR);  
        $stmt->bindValue(':currency_field', $this->currency_field, PDO::PARAM_STR);
        $stmt->bindValue(':date', $this->date, PDO::PARAM_STR);
        $stmt->bindValue(':selectCategory', $this->selectCategory, PDO::PARAM_STR);
        $stmt->bindValue(':comment', $this->comment, PDO::PARAM_STR);  
        
        return $stmt->execute();
    }

    public function showBalance($selectTimePeriode)
    {

        return static::findTimePeriode($selectTimePeriode) !== false;
     
    }
    
    public static function findTimePeriode($selectTimePeriode)
    {
        if($selectTimePeriode==0){

            $customPeriode  = 'MONTH(date_of_income) = MONTH(CURRENT_DATE())';

        }else if($selectTimePeriode==1){

            $customPeriode = 'MONTH(date_of_income) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)';
        
        }else if($selectTimePeriode==2){

            $customPeriode = 'YEAR(date_of_income) = YEAR(CURRENT_DATE())';
  
        }else if($_POST['selectTimePeriode'] == 3){
								
            $dateB = $_POST['dateBegin'];
            $dateE = $_POST['dateEnd'];			
            
            if($dateE < $dateB){
                $buffer = $dateE;
                $dateE = $dateB;
                $dateB = $buffer;
            }
            $customPeriode = ' date_of_income BETWEEN STR_TO_DATE(\''.$dateB.'\',\'%Y-%m-%d\')  AND STR_TO_DATE(\''.$dateE.'\',\'%Y-%m-%d\')';
                
        }
        return $customPeriode;
    }
    public static function findTimePeriodeE($selectTimePeriode)
    {
        if($selectTimePeriode==0){

            $customPeriodeE  = 'MONTH(date_of_expense) = MONTH(CURRENT_DATE())';

        }else if($selectTimePeriode==1){

            $customPeriodeE = 'MONTH(date_of_expense) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)'; 

        }else if($selectTimePeriode==2){

            $customPeriodeE = 'YEAR(date_of_expense) = YEAR(CURRENT_DATE())';

        }else if($_POST['selectTimePeriode'] == 3){	

            $dateB = $_POST['dateBegin'];
            $dateE = $_POST['dateEnd'];			
            
            if($dateE < $dateB){
                $buffer = $dateE;
                $dateE = $dateB;
                $dateB = $buffer;
            }

            $customPeriodeE = ' date_of_expense BETWEEN STR_TO_DATE(\''.$dateB.'\',\'%Y-%m-%d\')  AND STR_TO_DATE(\''.$dateE.'\',\'%Y-%m-%d\')';
        }

        return $customPeriodeE;
    }

    public static function getAllUserIncomes($selectTimePeriode)
    {
        $customPeriode = static::findTimePeriode($selectTimePeriode);
        $incomeTotal = 'SELECT SUM(amount) as sum FROM incomes WHERE '.$customPeriode;
        return static::findQueryResult($incomeTotal);
    }

    public static function getSalary($selectTimePeriode)
    {
        $customPeriode = static::findTimePeriode($selectTimePeriode);
        $salary = 'SELECT SUM(amount) as sum FROM incomes WHERE '.$customPeriode.'AND income_category_assigned_to_user_id = 0'; 
        return static::findQueryResult( $salary);
    }

    public static function getIntrest($selectTimePeriode)
    {
        $customPeriode = static::findTimePeriode($selectTimePeriode);
        $intrest = 'SELECT SUM(amount) as sum FROM incomes WHERE '.$customPeriode.'AND income_category_assigned_to_user_id = 1'; 
        return static::findQueryResult( $intrest);
    }

    public static function getAllegro($selectTimePeriode)
    {
        $customPeriode = static::findTimePeriode($selectTimePeriode);
        $allegro = 'SELECT SUM(amount) as sum FROM incomes WHERE '.$customPeriode.'AND income_category_assigned_to_user_id = 2'; 
        return static::findQueryResult( $allegro);
    }

    public static function getAnother($selectTimePeriode)
    {
        $customPeriode = static::findTimePeriode($selectTimePeriode);
        $another = 'SELECT SUM(amount) as sum FROM incomes WHERE '.$customPeriode.'AND income_category_assigned_to_user_id = 3';
        return static::findQueryResult( $another);
    }

    public static function getAllUserExpense($selectTimePeriode)
    {
        $customPeriode = static::findTimePeriodeE($selectTimePeriode);
        $sql = 'SELECT SUM(amount) as sum FROM expenses WHERE '.$customPeriode; 
        return static::findQueryResult($sql);
    }

    public static function getTransport($selectTimePeriode)
    {
        $customPeriode = static::findTimePeriodeE($selectTimePeriode);
        $transport = 'SELECT SUM(amount) as sum FROM expenses WHERE '.$customPeriode.'AND expense_category_assigned_to_user_id = 1'; 
        return static::findQueryResult($transport);
    }

    public static function getBooks($selectTimePeriode)
    {
        $customPeriode = static::findTimePeriodeE($selectTimePeriode);
        $books = 'SELECT SUM(amount) as sum FROM expenses WHERE '.$customPeriode.'AND expense_category_assigned_to_user_id = 2'; 
        return static::findQueryResult($books);
    }

    public static function getFood($selectTimePeriode)
    {
        $customPeriode = static::findTimePeriodeE($selectTimePeriode);
        $food = 'SELECT SUM(amount) as sum FROM expenses WHERE '.$customPeriode.'AND expense_category_assigned_to_user_id = 3'; 
        return static::findQueryResult($food);
    }

    public static function getApart($selectTimePeriode)
    {
        $customPeriode = static::findTimePeriodeE($selectTimePeriode);
        $Apart = 'SELECT SUM(amount) as sum FROM expenses WHERE '.$customPeriode.'AND expense_category_assigned_to_user_id = 4'; 
        return static::findQueryResult($Apart);
    }

    public static function getTelec($selectTimePeriode)
    {
        $customPeriode = static::findTimePeriodeE($selectTimePeriode);
        $Telec = 'SELECT SUM(amount) as sum FROM expenses WHERE '.$customPeriode.'AND expense_category_assigned_to_user_id = 5'; 
        return static::findQueryResult($Telec);
    }

    public static function getHealth($selectTimePeriode)
    {
        $customPeriode = static::findTimePeriodeE($selectTimePeriode);
        $health = 'SELECT SUM(amount) as sum FROM expenses WHERE '.$customPeriode.'AND expense_category_assigned_to_user_id = 6'; 
        return static::findQueryResult($health);
    }

    public static function getClothes($selectTimePeriode)
    {
        $customPeriode = static::findTimePeriodeE($selectTimePeriode);
        $clothes = 'SELECT SUM(amount) as sum FROM expenses WHERE '.$customPeriode.'AND expense_category_assigned_to_user_id = 7'; 
        return static::findQueryResult($clothes);
    }

    public static function getHygen($selectTimePeriode)
    {
        $customPeriode = static::findTimePeriodeE($selectTimePeriode);
        $hygen = 'SELECT SUM(amount) as sum FROM expenses WHERE '.$customPeriode.'AND expense_category_assigned_to_user_id = 8'; 
        return static::findQueryResult($hygen);
    }

    public static function getKids($selectTimePeriode)
    {
        $customPeriode = static::findTimePeriodeE($selectTimePeriode);
        $kids = 'SELECT SUM(amount) as sum FROM expenses WHERE '.$customPeriode.'AND expense_category_assigned_to_user_id = 9'; 
        return static::findQueryResult($kids);
    }

    public static function getRecreat($selectTimePeriode)
    {
        $customPeriode = static::findTimePeriodeE($selectTimePeriode);
        $recreat = 'SELECT SUM(amount) as sum FROM expenses WHERE '.$customPeriode.'AND expense_category_assigned_to_user_id = 10'; 
        return static::findQueryResult( $recreat);
    }

    public static function getTrip($selectTimePeriode)
    {
        $customPeriode = static::findTimePeriodeE($selectTimePeriode);
        $trip = 'SELECT SUM(amount) as sum FROM expenses WHERE '.$customPeriode.'AND expense_category_assigned_to_user_id = 11';  
        return static::findQueryResult( $trip);
    }

    public static function getSavin($selectTimePeriode)
    {
        $customPeriode = static::findTimePeriodeE($selectTimePeriode);
        $savin = 'SELECT SUM(amount) as sum FROM expenses WHERE '.$customPeriode.'AND expense_category_assigned_to_user_id = 12';  
        return static::findQueryResult($savin);
    }

    public static function getReti($selectTimePeriode)
    {
        $customPeriode = static::findTimePeriodeE($selectTimePeriode);
        $forReti = 'SELECT SUM(amount) as sum FROM expenses WHERE '.$customPeriode.'AND expense_category_assigned_to_user_id = 13'; 
        return static::findQueryResult($forReti);
    }

    public static function getDebt($selectTimePeriode)
    {
        $customPeriode = static::findTimePeriodeE($selectTimePeriode);
        $debt = 'SELECT SUM(amount) as sum FROM expenses WHERE '.$customPeriode.'AND expense_category_assigned_to_user_id = 14';
        return static::findQueryResult( $debt);
    }

    public static function getGift($selectTimePeriode)
    {
        $customPeriode = static::findTimePeriodeE($selectTimePeriode);
        $gift = 'SELECT SUM(amount) as sum FROM expenses WHERE '.$customPeriode.'AND expense_category_assigned_to_user_id = 15'; 
        return static::findQueryResult($gift);
    }

    public static function getAnoth($selectTimePeriode)
    {
        $customPeriode = static::findTimePeriodeE($selectTimePeriode);
        $expAnoth = 'SELECT SUM(amount) as sum FROM expenses WHERE '.$customPeriode.'AND expense_category_assigned_to_user_id = 16'; 
        return static::findQueryResult($expAnoth);
    }


    public static function findQueryResult($sql)
    {

        $db = static::getDB();

        $stmt = $db->prepare($sql);
        

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();
        
        return $stmt->fetchAll();
    }

}