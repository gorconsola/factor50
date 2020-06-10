<?php 

namespace App\Fields\FieldOptions;

use App\Fields\FieldOptions\Field;
use App\Fields\FieldOptions\BaseField;

class InputField extends Field implements BaseField
{
    protected $fieldType = 'InputField';
    protected $name;
    protected $label;
    protected $type;
    protected $dataType;
    protected $rules;
    protected $classes;

    public function __construct ($slug, $type = 'text', $rules = null, $classes = '') {
        $this->name = $slug;
        $this->label = $this->labelFromSlug($slug);
        $this->type = $type;
        $this->dataType = $this->setDataTypeWithType($type);
        $this->rules = $rules ?? $this->getDefaultRules();
        $this->classes = $classes;
    }

    public function getDefaultRules ()
    {   
        $result = "$this->dataType"; 

        if ($this->type === 'text') {
            $result = "$result|max:255";
        }

        return $result;
    }

    public function getFieldInfo ()
    {
        return [
            'fieldType' => $this->fieldType,
            'type' => $this->type,
            'dataType' => $this->dataType,
            'name' => $this->name,
            'label' => $this->label,
            'rules' => $this->rules,
            'classes' => $this->classes
        ];
    }

    private function setDataTypeWithType ($type)
    {
        switch ($type) {
            case 'number':
                $this->dataType = 'integer';
                break;
            default:
                $this->dataType = 'string';
                break;
        }
    }
}
