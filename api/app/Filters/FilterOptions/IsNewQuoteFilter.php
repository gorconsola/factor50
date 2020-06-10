<?php

namespace App\Filters\FilterOptions;

class IsNewQuoteFilter implements BaseFilter
{
    protected $type = 'IsNewQuoteFilter';
    protected $name = 'is_new';

    public function applyFilter ($query, $value)
    {
        return $query->whereHas('products', function ($q) use ($value) {
            $q->whereHas('baseProduct', function ($qq) use ($value) {
                $qq->where('is_new', intval($value));
            });
        });
    }

    public function getFilterInfo () {
        return [
            'name' => $this->name,
            'type' => $this->type
        ];
    }
}
