<?php

namespace App\Filters\FilterOptions;

class MachineClassFilter implements BaseFilter
{
	protected $type = 'MachineClassFilter';
	protected $name;

	public function __construct ($name) {
		$this->name = $name;
	}

    public function applyFilter ($query, $value)
    {
        $minMax = explode('-', $value);
        $min = $minMax[0];

        if (count($minMax) > 1)  {
            $max = $minMax[1];
        }

        $query->whereHas('products', function ($q) use ($min, $max) {
            if ($min) {
                $min = (int) $min;

                $q->where('machine_class_low', '<=', $min);
            }

            if ($max) {
                $q->where('machine_class_high', '>=', intval($max));
            }
        });
    }

    public function getFilterInfo () {
    	return [
            'name' => $this->name,
    		'type' => $this->type
    	];
    }
}
