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
        $user = Auth::getUser();

        $sql = 'INSERT INTO incomes (amount, date_of_income, income_category_assigned_to_user_id, income_comment, user_id)
        VALUES (:currency_field, :date, :selectCategory, :comment, :id)';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':currency_field', $this->currency_field, PDO::PARAM_STR);
        $stmt->bindValue(':date', $this->date, PDO::PARAM_STR);
        $stmt->bindValue(':selectCategory', $this->selectCategory, PDO::PARAM_STR);
        $stmt->bindValue(':comment', $this->comment, PDO::PARAM_STR);  
        $stmt->bindValue(':id',  $user->id, PDO::PARAM_STR);  

        return $stmt->execute();
    }
    /**
     * Save the expenses model with the current property values
     *
     * @return boolean  True if the expense was saved, false otherwise
     */
    public function addExpenseAmount()
    {
        $user = Auth::getUser();

        $sql = 'INSERT INTO expenses (amount, date_of_expense, expense_category_assigned_to_user_id, expense_comment, user_id)
        VALUES (:currency_field, :date, :selectCategory, :comment, :id)';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':currency_field', $this->currency_field, PDO::PARAM_STR);
        $stmt->bindValue(':date', $this->date, PDO::PARAM_STR);
        $stmt->bindValue(':selectCategory', $this->selectCategory, PDO::PARAM_STR);
        $stmt->bindValue(':comment', $this->comment, PDO::PARAM_STR);  
        $stmt->bindValue(':id',  $user->id, PDO::PARAM_STR);  

        return $stmt->execute();
    }

    public function showBalance()
    {
        $user = Auth::getUser();
        //return true;
       // return $stmt->execute();
     
    }

    public static function findTimePeriode($selectTimePeriode)
    {
        if($selectTimePeriode==0){

           $sql = 'SELECT * FROM incomes WHERE MONTH(date_of_income) = MONTH(CURRENT_DATE())';

        }else if($selectTimePeriode==1){

            $sql = "SELECT * FROM incomes WHERE MONTH(date_of_income) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)";
        
        }else if($selectTimePeriode==2){

            //$sql = "SELECT SUM(amount) FROM incomes WHERE YEAR(date_of_income) = YEAR(CURRENT_DATE())";
            $sql = "SELECT * FROM incomes WHERE YEAR(date_of_income) = YEAR(CURRENT_DATE())";

        }else if($_POST['selectTimePeriode'] == 3){
								
            $dateB = $_POST['dateBegin'];
            $dateE = $_POST['dateEnd'];			
            
            if($dateE < $dateB){
                $buffer = $dateE;
                $dateE = $dateB;
                $dateB = $buffer;
            }
            
        $sql = "SELECT * FROM incomes WHERE date_of_income BETWEEN STR_TO_DATE('$dateB','%Y-%m-%d')  AND STR_TO_DATE('$dateE','%Y-%m-%d')";
        
        }
        
        $db = static::getDB();

        $stmt = $db->prepare($sql);

        $stmt->execute();

        return $stmt->fetch();      
    }

}