<?php

namespace App\Filters\FilterOptions;

use App\MachineType;

class MachineTypeFilter implements BaseFilter
{
	protected $type = 'OptionsFilter';
	protected $name;
    protected $options;

	public function __construct ($name) {
		$this->name = $name;
        $this->options = MachineType::pluck('name')->all();
	}

    public function applyFilter ($query, $value)
    {
        $query->whereHas('productType', function ($subQuery) use ($value) {
            $subQuery->whereHas('machineType', function ($q) use ($value) {
                $optionArray = explode(',', $value);
                
                $q->whereIn('name', $optionArray);
            });
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
