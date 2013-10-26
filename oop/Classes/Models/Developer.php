<?php

namespace Classes\Models;

use Classes\Model;

class Developer extends Model
{
    public function loadModel($id)
    {
        $xml = $this->getXMLReader();

        $data = array();

        if (!$xml) return $data;

        while ($xml->read() && $xml->name !== 'developer') ;

        while ($xml->name === 'developer') {

            if ($xml->getAttribute("id") == $id) {
                $node = new SimpleXMLElement($xml->readOuterXML());
                $data = array(
                    'id' => $node->id,
                    'name' => $node->name,
                    'pay' => $node->pay,
                    'bonus' => $node->bonus,
                    'project' => $node->project,
                    'technologies' => $node->technologies
                );
                break;
            }

            $xml->next('product');
        }

        return $data;
    }

    public function loadAllModels()
    {
        $xml = $this->getXMLReader();

        $data = array();

        if (!$xml) return $data;

        while ($xml->read() && $xml->name !== 'developer') ;

        while ($xml->name === 'developer') {

            $node = new SimpleXMLElement($xml->readOuterXML());
            $data [] = array(
                'id' => $node->id,
                'name' => $node->name
            );

            $xml->next('product');
        }

        return $data;
    }
}