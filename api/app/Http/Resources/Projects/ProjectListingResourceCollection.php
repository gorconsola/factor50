<?php

namespace App\Http\Resources\Projects;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Projects\ProjectListingResource;
use App\Filters\ProjectFilters;

class ProjectListingResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $projectResource = new ProjectListingResource($this->resource);
        $columns = $projectResource->columns;
        $filters = new ProjectFilters($request);

        return [
            'data' => $this->collection,
            'filters' => $filters->getFiltersInfo(),
            'columns' => $columns
        ];
    }
}
