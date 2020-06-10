<?php 

namespace App\Fields;

use App\Fields\FieldOptions\InputField;
use App\Fields\FieldOptions\SelectField;
use App\Fields\FieldOptions\MultiValueField;

abstract class Fields
{
    protected $fields = [];

    // Backoffice frontend makes use of Bulma columns, use their classes from documentation
    protected $baseFieldClass = 'is-one-third';

    public function __construct($fields) {
        
    }

    public function getFields($filterArray = [])
    {   
        if (!!count($filterArray)) {
            return $this->getFilteredFields($filterArray);
        }

        return $this->fields;
    }

    public function inputField (
        $slug,
        $type = 'text',
        $rules = null,
        $classes = false
    )
    {
        if (!$classes) {
            $classes = $this->baseFieldClass;
        }

        return new InputField($slug, $type, $rules, $classes);
    }

    public function selectField (
        $slug,
        $options,
        $label = '',
        $rules = null,
        $classes = false)
    {
        if (!$classes) {
            $classes = $this->baseFieldClass;
        }

        $selectField = new SelectField($slug, $label, $rules, $classes);
        $selectField->setOptions($options);

        return $selectField;
    }

    public function multiValueField (
        $slug,
        $label = '',
        $rules = null,
        $classes = false )
    {
        if (!$classes) {
            $classes = $this->baseFieldClass;
        }

        $multiValueField = new MultiValueField($slug, $label, $rules, $classes);

        return $multiValueField;
    }

    public function getFilteredFieldInfo ($filterArray = [])
    {
        if (!count($filterArray)) {
            foreach ($this->fields as $field) {
                $filterArray[] = $field->getName();
            }
        }

        $result = [];

        foreach ($filterArray as $value) {
            if (isset($this->fields[$value])) {
                $result[] = $this->fields[$value]->getFieldInfo();
            }
        }

        return $this->fields = $result;
    }

    public function getRules ($method = '') {
        $result = [];

        foreach ($this->fields as $field) {
            $result[$field->getName()] = $field->getFieldRules($method);
        }

        return $result;
    }

    public function getFilteredFields ($filterArray)
    {       
        return array_filter( $this->fields, 
            function( $field ) use ( $filterArray ) {
                return in_array($field->getName(), $filterArray);
            }
        );
    }
}