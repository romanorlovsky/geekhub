<?php

namespace Classes\Validators;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

class Manager
{
    public function validateFields($data)
    {
        $validator = Validation::createValidator();

        $constraint = new Assert\Collection(array(
            'id' => new Assert\Type(array(
                    'type' => 'numeric',
                    'message' => '"ID" should be of type {{ type }}.'
                )),
            'name' => new Assert\Length(array(
                    'min' => 3,
                    'minMessage' => '"Name" is too short. It should have {{ limit }} characters or more.'
                )),
            'pay' => array(
                new Assert\Type(array(
                    'type' => 'numeric',
                    'message' => '"Pay" should be of type {{ type }}.'
                ))
            ),
            'bonus' => array(
                new Assert\Type(array(
                    'type' => 'numeric',
                    'message' => '"Bonus" should be of type {{ type }}.'
                ))
            ),
            'projects' => new Assert\Type(array(
                    'type' => 'numeric',
                    'message' => '"Projects" should be of type numeric.'
                ))
        ));

        $violations = $validator->validateValue($data, $constraint);

        if ($violations->has(0)) {

            $errors = array();

            foreach ($violations as $violation) {
                $errors[] = $violation->getMessage();
            }

            return $errors;
        }

        return true;
    }
}