<?php

namespace App\Helpers;

class StringHelper
{
    public static function doRegex(string $text, $rule)
    {
        preg_match_all($rule, $text, $result);

        return $result;
    }
}
