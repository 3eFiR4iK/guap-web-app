<?php

namespace App\Exception;

use RuntimeException;
use Symfony\Component\Validator\ConstraintViolation;

class InvalidDataInJson extends RuntimeException
{
    /**
     * @var ConstraintViolation[]
     */
    private $constraintViolations;

    /**
     * @param ConstraintViolation[] $constraintViolations
     */
    public function __construct(array $constraintViolations)
    {
        $this->message = 'Client sent JSON with invalid data';
        $this->constraintViolations = $constraintViolations;

        parent::__construct($this->message);
    }

    /**
     * @return ConstraintViolation[]
     */
    public function getConstraintViolationList(): array
    {
        return $this->constraintViolations;
    }
}
