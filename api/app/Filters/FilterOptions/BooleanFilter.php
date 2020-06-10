<?php

namespace App\Filters\FilterOptions;

class BooleanFilter implements BaseFilter
{
	protected $type = 'booleanFilter';
	protected $name;
    protected $options;

	public function __construct ($name, array $options = ['yes', 'no']) {
		$this->name = $name;

        $this->options = [
            ['label' => 'All', 'value' => null],
            ['label' => $options[0], 'value' => '1'],
            ['label' => $options[1], 'value' => '0']
        ];
	}

    public function applyFilter ($query, $value)
    {   
        if ($value !== 'null') {
    	   $query->where($this->name, $value);
        }
    }

    public function getFilterInfo () {
    	return [
            'name' => $this->name,
    		'type' => $this->type,
            'options' => $this->options
    	];
    }
}
