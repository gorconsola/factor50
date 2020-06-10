<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ListingResource extends JsonResource
{
    public $columns;

    public function showFields($resourceParams)
    {
        $result = [];

        foreach ($this->columns as $column) {

            $show = array_key_exists($column['label'], $resourceParams);

            if ($show) {
                $result[$column['label']] = $resourceParams[$column['label']];
            }
        }

        return $result;
    }

    public function column($label, $sortable = true) {
        return [
            'label' => $label,
            'sortable' => $sortable
        ];
    }

    public function setColumns (Array $columns)
    {
        return $this->columns = $columns;
    }
}
