<?php

namespace App\Http\Resources\Projects;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ListingResource;

class ProjectListingResource extends ListingResource
{
    public function __construct($resource)
    {
        $this->columns = [
            $this->column('id'),
            $this->column('name'),
            $this->column('status', false)
        ];

        $this->resource = $resource;
    }


    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'status' => $this->status
        ];
    }
}
