<?php

namespace App\Fields;

use App\Fields\Fields;
use Illuminate\Http\Request;

class ProjectDetailFields extends Fields
{
    public function __construct ()
    {
        $statusOptions = $this->createStatusOptions();

        $this->fields = [
            'title' => $this->inputField('title', 'text', 'required'),
            'status' => $this->selectField('status', $statusOptions, 'Status')
        ];
    }


    private function createStatusOptions () : array
    {
        return [
            ['label' => 'Open', 'value' => 'open'],
            ['label' => 'Closed', 'value' => 'closed']
        ];
    }
}