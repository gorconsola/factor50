<?php

namespace App\Fields;

use App\Brand;
use App\ProductType;
use App\MachineType;
use App\Fields\Fields;
use Illuminate\Http\Request;
use App\Fields\FieldOptions\SelectField;

class ProjectFields extends Fields
{
    public function __construct () {
        $statusOptions = $this->createStatusOptions();

        $this->fields = [
            'name' => $this->inputField('name', 'text', 'required'),
            // 'brand_id' => $this->createBrandField(),
            'brand' => $this->inputField('brand', 'text'),
            'product_type_id' => $this->createProductTypeField(),
            'weight' => $this->inputField('weight', 'number'),
            'year' => $this->inputField('year', 'number'),
            'price' => $this->inputField('price', 'number'),
            'identification_number' => $this->inputField('identification_number', 'text'),
            'serial_number' => $this->inputField('serial_number', ''),
            'description' => $this->inputField('description', 'textarea', '', 'is-full'),
            'status' => $this->selectField('status', $statusOptions, 'Status'),
            'meta_description' => $this->inputField('meta_description', 'textarea'),
        ];
    }

    public function createBrandOptions () {
        $brands = Brand::pluck('name', 'id')->all();

        $result = [];

        foreach ($brands as $id => $name) {
            $result[] = SelectField::createOption($name, $id);
        }

        return $result;
    }

    private function createProductTypeField ()
    {
        $productTypeOptions = $this->createProductTypeOptions($this->machineTypeId);
        $field = $this->selectField('product_type_id', $productTypeOptions, 'Product Type', 'required');
        $field->setDataTypeAndUpdateRules('integer');

        return $field;
    }

    public function createProductTypeOptions ($machineTypeId = null) {
        $query = ProductType::query();

        if ($machineTypeId) {
            $query->where('machine_type_id', $machineTypeId);
            $query->orderBy('order');
            $query->orderBy('name');
        }

        $productTypes = $query->pluck('name', 'id')->all();

        $result = [];

        foreach ($productTypes as $id => $name) {
            $result[] = SelectField::createOption($name, $id);
        }

        return $result;
    }

    public function createMachineTypeOptions () {
        $machineTypes = MachineType::pluck('name', 'id')->all();

        $result = [];

        foreach ($machineTypes as $id => $name) {
            $result[] = SelectField::createOption($name, $id);
        }

        return $result;
    }

    public function createStatusOptions () {
        return [
            ['label' => 'Open', 'value' => 'open'],
            ['label' => 'Closed', 'value' => 'closed']
        ];
    }

    private function createBrandField ()
    {
        $brandOptions = $this->createBrandOptions();
        $field = $this->selectField('brand_id', $brandOptions, 'Brand');
        $field->setDataTypeAndUpdateRules('integer');

        return $field;
    }
}