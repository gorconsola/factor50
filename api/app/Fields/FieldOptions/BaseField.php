<?php

namespace App\Fields\FieldOptions;

interface BaseField
{
	/**
     * Returns all the info relevant to the field
     *
     * @return Array
     */
    public function getFieldInfo();

    /**
     * Get the rules associated to the specific field, can take a request method
     *
     * @return String
     */
    public function getFieldRules(string $method);
}