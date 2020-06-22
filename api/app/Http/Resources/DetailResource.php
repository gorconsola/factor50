<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DetailResource extends JsonResource
{
    public function showFields($resourceParams)
    {
    	$result = [];

    	foreach ($this->fieldsToShow as $field) {

    		$show = array_key_exists($field, $resourceParams);

    		if ($show) {
    			$result[$field] = $resourceParams[$field];
    		}

            if ($field === 'machine_class') {
                $low = $resourceParams['machine_class_low'][0];
                $high = $resourceParams['machine_class_high'][0];

                $result[$field] = "$low - $high";
            }
    	}

    	return $result;
    }
}
