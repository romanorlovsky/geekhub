<?php
class Manager extends Employee
{
    private $numberOfProjects = 0;

    public function __construct($fullName, $id, $pay, $numberOfProjects)
    {
        parent::__construct($fullName, $id, $pay);
        $this->numberOfProjects = $numberOfProjects;
    }

    public function displayInfo()
    {
        parent::displayInfo();
        echo "Number of projects: ", $this->numberOfProjects;
    }
}