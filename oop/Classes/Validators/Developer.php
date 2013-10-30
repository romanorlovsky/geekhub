<?php

namespace Classes\Validators;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

class Developer
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
            'project' => new Assert\Length(array(
                    'min' => 2,
                    'minMessage' => '"Project" is too short. It should have {{ limit }} characters or more.'
                )),
            'technologies' => new Assert\Length(array(
                    'min' => 2,
                    'minMessage' => '"Technologies" is too short. It should have {{ limit }} characters or more.'
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