<?php

namespace App\Fields\FieldOptions;

use Str;

abstract class Field
{
    public function labelFromSlug ($slug)
    {
        return str_replace('_', ' ', Str::title($slug));
    }

    public function getName ()
    {
        return $this->name;
    }

    public function getDefaultRules ()
    {
        return "$this->dataType|nullable";
    }

    public function getFieldRules (string $method)
    {
        return $this->parseRulesWithMethod($method);
    }

    private function parseRulesWithMethod (string $method)
    {
        switch ($method) {
            case 'PATCH':
                return str_replace('required','nullable', $this->rules);
            default:
                return $this->rules;
        }
    }
}