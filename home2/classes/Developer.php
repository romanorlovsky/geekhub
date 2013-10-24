<?php
class Developer extends EmployeeAbstract implements FileInterface
{
    private $currentProject = '';
    private $technologies = '';

    public function __construct($fullName, $id, $pay, $currentProject, $technologies)
    {
        parent::__construct($fullName, $id, $pay);
        $this->setType('Developer');
        $this->currentProject = $currentProject;
        $this->technologies = $technologies;
    }

    public function giveBonus($amount)
    {
        $this->setBonus($amount + 50);
    }

    public function displayInfo()
    {
        parent::displayInfo();
        echo '&nbsp;&nbsp;&nbsp;&nbsp;', 'Current project: ', $this->currentProject, '<br>';
        echo '&nbsp;&nbsp;&nbsp;&nbsp;', 'Technologies: ', $this->technologies, '<br>';
        echo '--------------------------------------<br><br>';
    }

    public function readFile()
    {

    }

    public function writeFile()
    {

    }
}