<?php

namespace App\Filters\FilterOptions;

class MinMaxFilter implements BaseFilter
{
	protected $type = 'minMaxFilter';
	protected $name;

	public function __construct ($name) {
		$this->name = $name;
	}

    public function applyFilter ($query, $value)
    {
        $minMax = explode('-', $value);

        $min = $minMax[0];
        $max = false;

        if (count($minMax) > 1) {
            $max = $minMax[1];
        }

        if ($min) {
            $query->where($this->name, '>=' , $min);
        }

        if ($max) {
            $query->where($this->name, '<=' , $max);
        }
    }

    public function getFilterInfo () {
    	return [
            'name' => $this->name,
    		'type' => $this->type
    	];
    }
}
