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

        $xml = $this->getXMLReader();

        if (!$xml) return $data;

        while ($xml->read() && $xml->name !== 'developer') ;

        while ($xml->name === 'developer') {

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

            $xml->next('developer');
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

            $node = new \SimpleXMLElement($xml->readOuterXML());
            $data [] = array(
                'id' => $node->id,
                'name' => $node->name
            );

            $xml->next('developer');
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

    public function save($data)
    {
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

    public function validateFields($data)
    {
        $validator = Validation::createValidator();

        $constraint = new Assert\Collection(array(
            'id' => new Assert\Type(array(
                'type' => 'numeric',
                'message' => '"ID" should be of type numeric.'
            )),
            'name' => new Assert\Length(array(
                'min' => 3,
//                'message' => '"Name" is too short. It should have 3 characters or more.'
            )),
            'pay' => array(
//                new Assert\Required(array('message'=>'xxx')),
                new Assert\Type(array(
                    'type' => 'numeric',
                    'message' => '"Pay" should be of type numeric.'
                ))
            ),
            'bonus' => array(
//                new Assert\Blank(),
                new Assert\Type(array(
                    'type' => 'numeric',
                    'message' => '"Bonus" should be of type numeric.'
                ))
            ),
            'project' => new Assert\Length(array(
                'min' => 2,
//                'message' => '"Project" is too short. It should have 2 characters or more.'
            )),
            'technologies' => new Assert\Length(array(
                'min' => 2,
//                'message' => '"Technologies" is too short. It should have 3 characters or more.'
            ))
        ));

        $violations = $validator->validateValue($data, $constraint);

        if ($violations->has(0)) {
            return $violations->get(0)->getMessage();
        }

        return true;
    }
}