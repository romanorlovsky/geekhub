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
            'fields' => array(
                'id' => new Assert\Required(array(
                        new Assert\Type(array(
                            'type' => 'numeric',
                            'message' => '"ID" should be of type {{ type }}.'
                        ))
                    )),
                'name' => new Assert\Required(array(
                        new Assert\Length(array(
                            'min' => 3,
                            'minMessage' => '"Name" is too short. It should have {{ limit }} characters or more.'
                        ))
                    )),
                'pay' => array(
                    new Assert\Required(array(
                        new Assert\Type(array(
                            'type' => 'numeric',
                            'message' => '"Pay" should be of type {{ type }}.'
                        ))
                    ))
                ),
                'bonus' => new Assert\Optional(array(
                            new Assert\Type(array(
                                'type' => 'numeric',
                                'message' => '"Bonus" should be of type {{ type }}.'
                            ))
                        )
                    ),
                'projects' => new Assert\Required(array(
                        new Assert\Length(array(
                            'min' => 2,
                            'minMessage' => '"Projects" should be of type numeric.'
                        ))
                    ))
            ),
            'missingFieldsMessage' => "\"{{ field }}\" is missing"
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