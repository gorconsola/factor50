<?php

namespace App\Http\Resources\Projects;

use App\Fields\ProjectDetailFields;
use App\Http\Resources\DetailResource;
use Arr;

class ProjectDetailResource extends DetailResource
{
    protected $fieldsToShow = [
        'name',
        'status',
    ];

    /**
     * Create a new resource instance.
     *
     * @param  mixed  $resource
     * @return void
     */
    public function __construct($resource)
    {   
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
        $projectDetailFields = new ProjectDetailFields();

        $project = [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'status' => $this->resource->status
        ];

        if (isset($this->resource->address_id)) {
            $address = $this->resource->address->toArray();
            $address = Arr::except($address, 'id', 'address_id');

            return array_merge($project, $address);
        }

        return [
            'data' => $project,
            'meta' => [
                'fields' => $projectDetailFields->getFilteredFieldInfo($this->fieldsToShow)
            ]
        ];
    }
}
