<?php
class Manager extends Employee implements XML
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
        echo '&nbsp;&nbsp;&nbsp;&nbsp;', 'XML string: ', htmlspecialchars($this->genXML()), '<br>';
        echo '--------------------------------------<br><br>';
    }

    function genXML()
    {
        return
            <<<XMLFRAGMENT
    <manager>
        <name>{$this->getFullName()}</name>
        <id>{$this->getId()}</id>
        <pay>{$this->getPay()}</pay>
        <bonus>{$this->getBonus()}</bonus>
    </manager>
XMLFRAGMENT;
    }
}