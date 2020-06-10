<?php

namespace App\Filters\FilterOptions;

class OrderByFilter implements BaseFilter
{
	protected $type = 'OrderByFilter';
    protected $name = 'order_by';

    public function applyFilter ($query, $value)
    {
        $field = explode('-', $value)[0];

        $order = 'asc';

        if (count(explode('-', $value)) > 1) {
            $order = explode('-', $value)[1];
        }

    	$query->orderBy($field, $order);
    }

    public function getFilterInfo () {
    	return [
    		'type' => $this->type,
            'name' => $this->name
    	];
    }
}
