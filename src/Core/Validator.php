<?php

namespace App\Core;

class Validator
{
    public static function string($value): bool
    {
        return strlen(trim($value)) === 0;
    }
}