<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Material;
use App\Models\MaterialCategory;


class MaterialTable extends Component
{
    public $materials = [];

    public function mount()
    {
        $this->loadMaterials();
    }

    public function loadMaterials()
    {
        $this->materials = Material::all()->toArray();
    }

    public function addRow()
    {
        $this->materials[] = [
            'id' => null,
            'material_code' => '',
            'material_name' => '',
            'material_category_id' => null,
            'unit' => '',
            'stock_quantity' => 0,
            'location' => '',
            'status' => 'ACTIVE',
        ];
    }
    public function save()
    {
        $this->validate([
        'materials.*.material_code' => 'required',
        'materials.*.material_name' => 'required',
        'materials.*.material_category_id' => 'required|integer',
]);
        foreach ($this->materials as $row) {

        if (
            empty($row['material_code']) ||
            empty($row['material_name']) ||
            empty($row['material_category_id'])
        )   {
        continue;
    }

            Material::updateOrCreate(
                ['id' => $row['id'] ?? null],
                [
                    'material_code' => $row['material_code'],
                    'material_name' => $row['material_name'],
                    'material_category_id' => $row['material_category_id'],
                    'unit' => $row['unit'],
                    'stock_quantity' => $row['stock_quantity'],
                    'location' => $row['location'],
                    'status' => $row['status'],
                ]
            );
        }

        session()->flash('success', 'Materials Saved');

        $this->loadMaterials();
    }

    public function deleteRow($index)
    {
        if (!empty($this->materials[$index]['id'])) {
            Material::find($this->materials[$index]['id'])?->delete();
        }

        unset($this->materials[$index]);

        $this->materials = array_values($this->materials);
    }

    public function render()
    {
        return view('livewire.material-table', [
            'categories' => MaterialCategory::all()
        ]);
    }
}