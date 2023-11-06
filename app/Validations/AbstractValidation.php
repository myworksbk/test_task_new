<?php

namespace App\Validations;

abstract class AbstractValidation
{
    abstract public static function validate(array $data): array;
}
