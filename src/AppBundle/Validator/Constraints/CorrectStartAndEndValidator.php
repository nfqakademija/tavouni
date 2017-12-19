<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CorrectStartAndEndValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if ($value !== null && $value->getStart() >= $value->getEnd()) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}