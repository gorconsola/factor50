<?php

namespace App\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class ProjectFilters extends QueryFilters
{
	public function __construct (Request $request) {
		$this->request = $request;
		$this->filters = [
			'order_by' => $this->orderBy(),
			'name' => $this->searchFilter('name'),
			'status' => $this->enumFilter('status', array('open', 'closed')),
		];
	}
}