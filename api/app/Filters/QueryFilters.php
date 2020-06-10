<?php

namespace App\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\FilterOptions\EnumFilter;
use App\Filters\FilterOptions\SearchFilter;
use App\Filters\FilterOptions\MinMaxFilter;
use App\Filters\FilterOptions\OptionsFilter;
use App\Filters\FilterOptions\OrderByFilter;
use App\Filters\FilterOptions\BooleanFilter;

abstract class QueryFilters
{

    /**
     * The request object.
     *
     * @var Request
     */
    
    protected $request;


    protected $filters = [];

    /**
     * The builder instance.
     *
     * @var Builder
     */
    
    protected $builder;


    /**
     * Create a new QueryFilters instance.
     *
     * @param Request $request
     */
    
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    /**
     * Apply the filters to the builder.
     *
     * @param  Builder $builder
     * @return Builder
     */
    
    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->querystringFilters() as $name => $value) {
            if (!array_key_exists($name, $this->filters)) {
                continue;
            }
            
            $this->filters[$name]->applyFilter($this->builder, $value);
        }

        return $this->builder;
    }


    /**
     * Get all request filters data.
     *
     * @return array
     */
    
    public function querystringFilters()
    {
        return $this->request->all();
    }


    /**
     * Get info of all filters for response.
     *
     * @return array
     */
    
    public function getFiltersInfo () {
        $result = [];

        foreach ($this->filters as $filter) {
            $filterInfo = $filter->getFilterInfo();
            $name = $filterInfo['name'];

            $filterInfo['value'] = $this->getValueFromQueryString($name);
            $result[$name] = $filterInfo;
        }

        return $result;
    }

    public function getValueFromQueryString ($name) {
        $queryString = $this->queryStringFilters();

        if (isset($queryString[$name])) {
            return $queryString[$name];
        }

        return '';
    }

    public function optionsFilter(String $name, $options, String $relation, String $column = '')
    {
        if (!$column) {
            $column = $name;
        }

        if ($options instanceof Model) {
            $options = $options->pluck($column)->all();
        }

        return new OptionsFilter($name, $options, $relation, $column);
    }

    public function enumFilter(String $name, $options)
    {
        return new EnumFilter($name, $options);
    }

    public function searchFilter(String $name, String $relation = '')
    {
        return new SearchFilter($name, $relation);
    }

    public function minMaxFilter(String $name)
    {
        return new MinMaxFilter($name);
    }

    public function booleanFilter(String $name, Array $options = ['yes', 'no'] )
    {
        return new BooleanFilter($name, $options);
    }

    public function orderBy ()
    {
        return new OrderByFilter();
    }
}
