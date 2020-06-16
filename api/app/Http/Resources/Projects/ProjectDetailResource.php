<?php

namespace App\Http\Resources\Projects;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $project = [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'status' => $this->resource->status
        ];

        if (isset($this->resources->address_id)) {
            $address = $this->resource->address->toArray();
            
            return array_merge($project, $address);
        }

        return $project;
    }
}
