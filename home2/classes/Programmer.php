<?php
class Programmer extends Employee
{
    private $currentProject = '';
    private $technologies = '';

    public function __construct($fullName, $id, $pay, $currentProject,$technologies)
    {
        parent::__construct($fullName, $id, $pay);
        $this->currentProject = $currentProject;
        $this->technologies = $technologies;
    }

    public function displayInfo()
    {
        parent::displayInfo();
        echo "Current project: ", $this->currentProject;
        echo "Technologies: ", $this->technologies;
    }
}