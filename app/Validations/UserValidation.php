<?php

namespace App\Validations;
use Exception;

class UserValidation extends AbstractValidation
{
    public static function validate(array $data): array
    {
        $isValid = (
            isset($data["first_name"]) && $data["first_name"]
            && isset($data["last_name"]) && $data["last_name"]
            && isset($data["position_id"]) && $data["position_id"]
        );

        if (!$isValid) {
            throw new Exception("Error Validate Request");
            
        }

        return $data;
    }
}