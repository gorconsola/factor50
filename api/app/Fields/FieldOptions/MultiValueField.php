<?php 

namespace App\Fields\FieldOptions;

use App\Fields\FieldOptions\Field;
use App\Fields\FieldOptions\BaseField;

class MultiValueField extends Field implements BaseField
{
	protected $fieldType = 'MultiValueField';
	protected $name;
	protected $label;
	protected $type;
	protected $dataType;
	protected $rules;
	protected $classes;
	protected $singleValue = false;

	public function __construct ($slug, $label = '', $rules = null, $classes = '') {
		$this->name = $slug;
		$this->label = $label ? $label : $this->multiValueLabelFromSLug($slug);
		$this->rules = $rules ?: $this->getDefaultRules();;
		$this->dataType = 'string';
		$this->classes = $classes;
	}


	public function getFieldInfo ()
	{
		return [
            'fieldType' => $this->fieldType,
            'name' => $this->name,
            'label' => $this->label,
            'rules' => $this->rules,
            'dataType' => $this->dataType,
            'classes' => $this->classes,
            'singleValue' => $this->singleValue
		];
	}

	public function multiValueLabelFromSLug ($slug) { 
		return $this->labelFromSlug($slug) . ' options';
	}

	public function setSingleValue (bool $value) {
		return $this->singleValue = $value;
	}
}
