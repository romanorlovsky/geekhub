<?php

namespace Classes\Models;

use Classes\Model;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

class Developer extends Model
{
    public function loadModel($id)
    {
        $data = array();

        if (!$id) return $data;

        $container = 'developer';

        $xml = $this->getXMLReader($container);

        if (!$xml) return $data;

        while ($xml->read() && $xml->name !== $container) ;

        while ($xml->name === $container) {

            if ($xml->getAttribute("id") == $id) {
                $node = new \SimpleXMLElement($xml->readOuterXML());
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

            $xml->next($container);
        }

        return $data;
    }

    public function loadAllModels()
    {
        $container = 'developer';

        $xml = $this->getXMLReader($container);

        $data = array();

        if (!$xml) return $data;

        while ($xml->read() && $xml->name !== $container) ;

        while ($xml->name === $container) {

            $node = new \SimpleXMLElement($xml->readOuterXML());
            $data [] = array(
                'id' => $node->id,
                'name' => $node->name
            );

            $xml->next($container);
        }

        return $data;
    }

    public function getAttributes($request)
    {
        if (empty($request)) $request = Request::createFromGlobals();

        $data = array();

        if (!$request) return $data;

        if (!$request->request->get('id')) {
            return $data;
        } else {
            $data['id'] = $request->request->get('id');
        }

        if ($request->request->get('name')) {
            $data['name'] = $request->request->get('name');
        }

        if ($request->request->get('pay')) {
            $data['pay'] = $request->request->get('pay');
        }

        if ($request->request->get('bonus')) {
            $data['bonus'] = $request->request->get('bonus');
        }

        if ($request->request->get('project')) {
            $data['project'] = $request->request->get('project');
        }

        if ($request->request->get('technologies')) {
            $data['technologies'] = $request->request->get('technologies');
        }

        return $data;
    }

    public function create($data)
    {
        if (empty($data) || !is_array($data)) return false;

        $container = 'developer';

        $xmlContent = $this->getXMLReader($container, false);

        if (!$xmlContent) {
            $xmlWriter = new \XMLWriter();
            $xmlWriter->openMemory();
            $xmlWriter->startDocument();
            $xmlWriter->startElement($container . 's');
            $xmlWriter->endElement();
            $xmlContent = $xmlWriter->outputMemory();
        }

        $xml = new \SimpleXMLElement($xmlContent);

        $newChild = $xml->addChild($container);

        $newChild->addAttribute("id", $data['id']);
        $newChild->addChild('id', $data['id']);
        $newChild->addChild('name', $data['name']);
        $newChild->addChild('pay', $data['pay']);
        $newChild->addChild('bonus', $data['bonus']);
        $newChild->addChild('project', $data['project']);
        $newChild->addChild('technologies', $data['technologies']);

        $this->saveXML($xml->asXML());

        return true;
    }

    public function save($data)
    {
        if (empty($data) || !is_array($data)) return false;

        $developer = $data['id'];
        $parent = new \DomDocument;
        $parentNode = $parent->createElement('developer');

        $attribute = $parent->createAttribute("id");

        $attribute->value = $developer;
        $parentNode->appendChild($attribute);

        $parentNode->appendChild($parent->createElement('id', $data['id']));
        $parentNode->appendChild($parent->createElement('name', $data['name']));
        $parentNode->appendChild($parent->createElement('pay', $data['pay']));
        $parentNode->appendChild($parent->createElement('bonus', $data['bonus']));
        $parentNode->appendChild($parent->createElement('project', $data['project']));
        $parentNode->appendChild($parent->createElement('technologies', $data['technologies']));

        $parent->appendChild($parentNode);

        $dom = $this->getDomDocument();

        if (!$dom) return false;

        $xpath = new \DOMXpath($dom);
        $nodeList = $xpath->query("/developers/developer[@id={$developer}]");

        $oldNode = $nodeList->item(0);

        $newNode = $dom->importNode($parent->documentElement, true);

        $oldNode->parentNode->replaceChild($newNode, $oldNode);

        $this->saveXML($dom->saveXML());

        return true;
    }

    public function remove($id)
    {
        if (!$id) return false;

        $developer = $id;
        $dom = $this->getDomDocument();

        if (!$dom) return false;

        $xpath = new \DOMXpath($dom);
        $nodeList = $xpath->query("/developers/developer[@id={$developer}]");

        $oldNode = $nodeList->item(0);

        $oldNode->parentNode->removeChild($oldNode);

        $this->saveXML($dom->saveXML());

        return true;
    }
}