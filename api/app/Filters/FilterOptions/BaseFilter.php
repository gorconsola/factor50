<?php

namespace App\Filters\FilterOptions;

interface BaseFilter
{
	/**
     * Add the filter values to the queryBuilder instance
     *
     * @return Builder
     */
	public function applyFilter($query, $value);

	/**
     * Return filter characteristics in array form
     *
     * @return Filter type, meta-info
     */
	public function getFilterInfo();
}