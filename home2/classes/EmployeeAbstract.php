<?php
abstract class EmployeeAbstract
{
    private $fullName = '';
    private $id = 0;
    private $pay = 0;
    private $bonus = 0;
    private $type = '';

    public function __construct($fullName, $id, $pay)
    {
        $this->fullName = $fullName;
        $this->id = $id;
        $this->pay = $pay;
    }

    abstract protected function giveBonus($amount);

    public function displayInfo()
    {
        echo '--------------------------------------<br>';
        echo $this->type, ':<br>';
        echo '&nbsp;&nbsp;&nbsp;&nbsp;', 'Full name: ', $this->fullName, '<br>';
        echo '&nbsp;&nbsp;&nbsp;&nbsp;', 'Id: ', $this->id, '<br>';
        echo '&nbsp;&nbsp;&nbsp;&nbsp;', 'Pay: ', $this->pay, '<br>';
        echo '&nbsp;&nbsp;&nbsp;&nbsp;', 'Pay rise: ', $this->bonus, '<br>';
        echo '&nbsp;&nbsp;&nbsp;&nbsp;', 'Pay with premium: ', $this->pay + $this->bonus, '<br>';
    }

    public function getFullName()
    {
        return $this->fullName;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPay()
    {
        return $this->pay;
    }

    protected function setBonus($bonus)
    {
        $this->bonus = $bonus;
    }

    public function getBonus()
    {
        return $this->bonus;
    }

    protected function setType($type)
    {
        $this->type = $type;
    }
}