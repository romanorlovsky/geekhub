<?php

namespace Classes;

abstract class Model
{
    protected $dbFile = '';
    private $object = '';

    public function __construct($object)
    {
        $this->object = $object;
        $this->dbFile = realpath(dirname(__FILE__) . "/../database") . '/' . $object . '.xml';
    }

    public function getXMLReader()
    {
        if (!file_exists($this->dbFile)) {
            $this->dbFile = realpath(dirname(__FILE__) . "/../database") . '/' . $this->object . '.xml';

            $xml = new \XMLWriter();
            $xml->openMemory();
            $xml->startDocument();

            $this->saveXML($xml->outputMemory());
        }

        $xml = new \XMLReader();
        $xml->xml(file_get_contents($this->dbFile));

        return $xml;
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