<?php 

namespace App\Fields\FieldOptions;

use App\Fields\FieldOptions\Field;
use App\Fields\FieldOptions\BaseField;

class SelectField extends Field implements BaseField
{
	protected $fieldType = 'SelectField';
	protected $name;
	protected $label;
	protected $options;
	protected $dataType;
	protected $rules;
	protected $classes;

	public function __construct ($slug, $label = '', $rules = null, $classes = '') {
		$this->name = $slug;
		$this->label = $label ? $label : $this->labelFromSlug($slug);
		$this->dataType = 'string';
		$this->rules = $rules ?: $this->getDefaultRules();
		$this->classes = $classes;
	}

	public function setDataTypeAndUpdateRules (string $dataType)
	{	
		$oldDataType = $this->dataType;
		$this->dataType = $dataType;

		$this->rules = str_replace($oldDataType, $dataType, $this->rules);
	}

	public function getFieldInfo ()
	{
		return [
            'name' => $this->name,
            'label' => $this->label,
            'options' => $this->options,
            'fieldType' => $this->fieldType,
            'dataType' => $this->dataType,
            'rules' => $this->rules,
            'classes' => $this->classes
		];
	}

	public function setOptions ($options) {
		return $this->options = $options;
	}

	public static function createOption($label, $value) {
		return [
			'label' => $label,
			'value' => "$value"
		];
	}
}
