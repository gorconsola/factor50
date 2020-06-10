<?php

namespace App\Filters\FilterOptions;

class EnumFilter implements BaseFilter
{
	protected $type = 'EnumFilter';
	protected $name;
	protected $options;
	protected $relation;

	public function __construct ($name, $options) {
		$this->name = $name;
		$this->options = $options;
	}

    public function applyFilter ($query, $value)
    {
    	$optionArray = explode(',', $value);

		$query->whereIn($this->name, $optionArray);
    }

    public function getFilterInfo () {
    	return [
            'name' => $this->name,
    		'type' => $this->type,
    		'options' => $this->options
    	];
    }
}
