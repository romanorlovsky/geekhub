<?php
class Manager extends EmployeeAbstract implements FileInterface
{
    private $numberOfProjects = 0;

    public function __construct($fullName, $id, $pay, $numberOfProjects)
    {
        parent::__construct($fullName, $id, $pay);
        $this->setType('Manager');
        $this->numberOfProjects = $numberOfProjects;
    }

    public function giveBonus($amount)
    {
        $this->setBonus($amount + 10);
    }

    public function displayInfo()
    {
        parent::displayInfo();
        echo '&nbsp;&nbsp;&nbsp;&nbsp;', 'Number of projects: ', $this->numberOfProjects, '<br>';
        echo '--------------------------------------<br><br>';
    }

    public function readFile()
    {

    }

    public function writeFile()
    {

    }
}