<?php

namespace App\Filters\FilterOptions;

class OptionsFilter implements BaseFilter
{
	protected $type = 'OptionsFilter';
	protected $name;
	protected $options;
	protected $relation;
    protected $column;

	public function __construct ($name, $options, $relation, $column) {
		$this->name = $name;
		$this->options = $options;
		$this->relation = $relation;
        $this->column = $column;
	}

    public function applyFilter ($query, $value)
    {
    	$optionArray = explode(',', $value);

    	$query->whereHas($this->relation, function ($q) use ($optionArray) {
    		$q->whereIn($this->column, $optionArray);
    	});
    }

    public function getFilterInfo () {
    	return [
            'name' => $this->name,
    		'type' => $this->type,
    		'options' => $this->options
    	];
    }
}
