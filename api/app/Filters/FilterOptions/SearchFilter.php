<?php

namespace App\Filters\FilterOptions;

class SearchFilter implements BaseFilter
{
	protected $type = 'SearchFilter';
	protected $name;
    protected $relation;

	public function __construct ($name, $relation = '') {
		$this->name = $name;
        $this->relation = $relation;
	}

    public function applyFilter ($query, $value)
    {   
        if ($this->relation) {
            return $query->whereHas($this->relation, function ($q) use ($value) {
        	   $q->where($this->name, 'LIKE', "%$value%");
            });
        }

        return $query->where($this->name, 'LIKE', "%$value%");
    }

    public function getFilterInfo () {
    	return [
            'name' => $this->name,
    		'type' => $this->type
    	];
    }
}
