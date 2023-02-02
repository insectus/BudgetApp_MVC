<?php

namespace App\Models;

use PDO;
use \Core\View;
use \App\Auth;


/**
 * User model
 *
 * PHP version 7.0
 */
class MoneyRotation extends \Core\Model
{
    protected function before()
    {
        parent::before();

        $this->user = Auth::getUser();
    }
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
     * Save the user model with the current property values
     *
     * @return boolean  True if the user was saved, false otherwise
     */
    public function addAmount()
    {

        $sql = 'INSERT INTO incomes (amount, date_of_income, income_category_assigned_to_user_id, income_comment)
        VALUES (:currency_field, :date, :selectCategory, :comment)'; //, :user.id

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':currency_field', $this->currency_field, PDO::PARAM_STR);
        $stmt->bindValue(':date', $this->date, PDO::PARAM_STR);
        $stmt->bindValue(':selectCategory', $this->selectCategory, PDO::PARAM_STR);
        $stmt->bindValue(':comment', $this->comment, PDO::PARAM_STR);  
       // $stmt->bindValue(':user_id', $this->user_id, PDO::PARAM_STR);  

        return $stmt->execute();

    }

}