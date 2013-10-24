<?php
abstract class Employee
{
    private $fullName = '';
    private $id = 0;
    private $pay = 0;
    private $bonus = 0;

    public function __construct($fullName, $id, $pay)
    {
        $this->fullName = $fullName;
        $this->id = $id;
        $this->pay = $pay;
    }

    public function giveBonus($bonus)
    {
        $this->bonus = $bonus;
    }

    public function displayInfo()
    {
        echo "Full name: ", $this->fullName, "\n";
        echo "Id: ", $this->id, "\n";
        echo "Pay: ", $this->pay, "\n";
        echo "Pay rise: ", $this->bonus, "\n";
        echo "Pay wth premium: ", $this->pay + $this->bonus, "\n";
    }
}