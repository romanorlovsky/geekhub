<?php

namespace Classes\Abstracts;

abstract class Model
{
    protected $dbFile = '';
    private $object = '';

    public function __construct($object)
    {
        $this->object = $object;
        $this->dbFile = realpath(dirname(__FILE__) . "/../../database") . '/' . $object . '.xml';
    }

    public function getXMLReader($container, $xml = true)
    {
        if (!file_exists($this->dbFile)) {
            $this->dbFile = realpath(dirname(__FILE__) . "/../../database") . '/' . $this->object . '.xml';

            $xmlWriter = new \XMLWriter();
            $xmlWriter->openMemory();
            $xmlWriter->startDocument();
            $xmlWriter->startElement($container . 's');
            $xmlWriter->endElement();

            $this->saveXML($xmlWriter->outputMemory());
        }

        if ($xml) {
            $xml = new \XMLReader();
            $xml->xml(file_get_contents($this->dbFile));

            return $xml;
        }

        return file_get_contents($this->dbFile);
    }

    public function getDomDocument()
    {
        if (!file_exists($this->dbFile)) return null;

        $dom = new \DomDocument();
        $dom->loadXML(file_get_contents($this->dbFile));

        return $dom;
    }

    public function saveXML($data)
    {
        $fp = fopen($this->dbFile, 'w');
        fwrite($fp, $data);
        fclose($fp);
    }
}