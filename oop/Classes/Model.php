<?php

namespace Classes;

abstract class Model
{
    protected $dbFile = '';

    public function __construct($object)
    {
        $this->dbFile = realpath(dirname(__FILE__) . "/../database") . '/' . $object . '.xml';
    }

    public function getXMLReader()
    {
        if (!file_exists($this->dbFile)) return null;

        $xml = new XMLReader();
        $xml->xml($this->dbFile);

        return $xml;
    }

    abstract public function loadModel($id);
    abstract public function loadAllModels();
}