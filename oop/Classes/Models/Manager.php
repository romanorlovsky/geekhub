<?php

namespace Classes\Models;

use Classes\Model;

class Manager extends Model
{
    public function loadModel($id)
    {
        $xml = $this->getXMLReader();

        $data = array();

        if (!$xml) return $data;

        while ($xml->read() && $xml->name !== 'manager') ;

        while ($xml->name === 'manager') {

            if ($xml->getAttribute("id") == $id) {
                $node = new \SimpleXMLElement($xml->readOuterXML());
                $data = array(
                    'id' => $node->id,
                    'name' => $node->name,
                    'pay' => $node->pay,
                    'bonus' => $node->bonus,
                    'projects' => $node->projects
                );
                break;
            }

            $xml->next('manager');
        }

        return $data;
    }

    public function loadAllModels()
    {
        $xml = $this->getXMLReader();

        $data = array();

        if (!$xml) return $data;

        while ($xml->read() && $xml->name !== 'manager');

        while ($xml->name === 'manager') {

            $node = new \SimpleXMLElement($xml->readOuterXML());
            $data [] = array(
                'id' => $node->id,
                'name' => $node->name
            );

            $xml->next('manager');
        }

        return $data;
    }
}