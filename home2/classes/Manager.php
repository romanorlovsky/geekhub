<?php
class Manager extends EmployeeAbstract implements XMLInterface, TXTInterface
{
    private $numberOfProjects = 0;
    private $xmlFile = '';
    private $txtFile = '';

    public function __construct($fullName, $id, $pay, $numberOfProjects)
    {
        parent::__construct($fullName, $id, $pay);
        $this->setType('Manager');
        $this->numberOfProjects = $numberOfProjects;

        $path = realpath(dirname(__FILE__) . "/../files/");
        $this->xmlFile = $path . "/manager.xml";
        $this->txtFile = $path . "/manager.txt";
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
        if(!file_exists($this->xmlFile)) {
            echo 'XML file not found';
            return;
        }

        $xml = new XMLReader();
        $xml->xml(file_get_contents($this->xmlFile));

        while ($xml->read() && $xml->name !== 'manager') ;

        while ($xml->name === 'manager') {
            $node = new SimpleXMLElement($xml->readOuterXML());

            echo 'Manager XML:<br>';
            echo '&nbsp;&nbsp;&nbsp;&nbsp;', 'Full name: ', $node->name, '<br>';
            echo '&nbsp;&nbsp;&nbsp;&nbsp;', 'Id: ', $node->id, '<br>';
            echo '&nbsp;&nbsp;&nbsp;&nbsp;', 'Pay: ', $node->pay, '<br>';
            echo '&nbsp;&nbsp;&nbsp;&nbsp;', 'Pay rise: ', $node->bonus, '<br>';
            echo '&nbsp;&nbsp;&nbsp;&nbsp;', 'Pay with premium: ', $node->pay + $node->bonus, '<br>';
            echo '&nbsp;&nbsp;&nbsp;&nbsp;', 'Number of projects: ', $node->projects, '<br>';

            $xml->next('manager');
        }
    }

    public function writeXMLFile()
    {
        try {
            $xml = new XMLWriter();
            $xml->openMemory();
            $xml->startDocument();
            $xml->startElement("manager");
            $xml->writeElement("id", $this->getId());
            $xml->writeElement("name", $this->getFullName());
            $xml->writeElement("pay", $this->getPay());
            $xml->writeElement("bonus", $this->getBonus());
            $xml->writeElement("projects", $this->numberOfProjects);
            $xml->endElement();

            $fp = fopen($this->xmlFile, 'w');
            fwrite($fp, $xml->outputMemory());
            fclose($fp);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function readTXTFile()
    {
        try {
            $fp = fopen($this->txtFile, 'r');
            echo 'Manager TXT:<br>';
            while (($buffer = fgets($fp, 4096)) !== false) {
                echo '&nbsp;&nbsp;&nbsp;&nbsp;', $buffer, '<br>';
            }
            fclose($fp);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function writeTXTFile()
    {
        try {
            $fp = fopen($this->txtFile, 'w');
            fwrite($fp, 'Full name: ' . $this->getFullName() . "\n");
            fwrite($fp, 'Id: ' . $this->getId() . "\n");
            fwrite($fp, 'Pay: ' . $this->getPay() . "\n");
            fwrite($fp, 'Pay rise: ' . $this->getBonus() . "\n");
            fwrite($fp, 'Pay with premium: ' . ($this->getPay() + $this->getBonus()) . "\n");
            fwrite($fp, 'Number of projects: ' . $this->numberOfProjects);
            fclose($fp);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}