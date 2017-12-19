<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class CorrectStartAndEnd extends Constraint
{
    public $message = 'Pradždios laikas turi būti mažensis už pabaigos laiką!';
}
