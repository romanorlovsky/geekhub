<?php
class Manager extends EmployeeAbstract implements XMLInterface, TXTInterface
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

    public function readXMLFile()
    {

    }

    public function writeXMLFile()
    {

    }

    public function readTXTFile()
    {

    }

    public function writeTXTFile()
    {

    }
}