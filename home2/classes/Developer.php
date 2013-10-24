<?php
class Developer extends EmployeeAbstract implements XMLInterface, TXTInterface
{
    private $currentProject = '';
    private $technologies = '';
    private $xmlFile = '';
    private $txtFile = '';

    public function __construct($fullName, $id, $pay, $currentProject, $technologies)
    {
        parent::__construct($fullName, $id, $pay);
        $this->setType('Developer');
        $this->currentProject = $currentProject;
        $this->technologies = $technologies;

        $path = realpath(dirname(__FILE__) . "/../files/");
        $this->xmlFile = $path . "/developer.xml";
        $this->txtFile = $path . "/developer.txt";
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

    public function readXMLFile()
    {
        if(!file_exists($this->xmlFile)) {
            echo 'XML file not found';
            return;
        }

        $xml = new XMLReader();
        $xml->xml(file_get_contents($this->xmlFile));

        while ($xml->read() && $xml->name !== 'developer') ;

        while ($xml->name === 'developer') {
            $node = new SimpleXMLElement($xml->readOuterXML());

            echo 'Developer XML:<br>';
            echo '&nbsp;&nbsp;&nbsp;&nbsp;', 'Full name: ', $node->name, '<br>';
            echo '&nbsp;&nbsp;&nbsp;&nbsp;', 'Id: ', $node->id, '<br>';
            echo '&nbsp;&nbsp;&nbsp;&nbsp;', 'Pay: ', $node->pay, '<br>';
            echo '&nbsp;&nbsp;&nbsp;&nbsp;', 'Pay rise: ', $node->bonus, '<br>';
            echo '&nbsp;&nbsp;&nbsp;&nbsp;', 'Pay with premium: ', $node->pay + $node->bonus, '<br>';
            echo '&nbsp;&nbsp;&nbsp;&nbsp;', 'Current project: ', $node->project, '<br>';
            echo '&nbsp;&nbsp;&nbsp;&nbsp;', 'Technologies: ', $node->technologies, '<br>';

            $xml->next('developer');
        }
    }

    public function writeXMLFile()
    {
        try {
            $xml = new XMLWriter();
            $xml->openMemory();
            $xml->startDocument();
            $xml->startElement("developer");
            $xml->writeElement("id", $this->getId());
            $xml->writeElement("name", $this->getFullName());
            $xml->writeElement("pay", $this->getPay());
            $xml->writeElement("bonus", $this->getBonus());
            $xml->writeElement("project", $this->currentProject);
            $xml->writeElement("technologies", $this->technologies);
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
            echo 'Developer TXT:<br>';
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
            fwrite($fp, 'Pay with premium: ' . $this->getPay() . $this->getBonus() . "\n");
            fwrite($fp, 'Current project: ' . $this->currentProject . "\n");
            fwrite($fp, 'Technologies: ' . $this->technologies);
            fclose($fp);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}