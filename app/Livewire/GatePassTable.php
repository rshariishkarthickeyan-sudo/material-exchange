<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\GatePass;
use App\Models\GatePassMaterial;
use App\Models\Material;

class GatePassTable extends Component
{
    public $gate_pass_no;

    public $category = 'RETURNABLE';

    // Prepared By
    public $prepared_name = '';
    public $prepared_ic_no = '';
    public $prepared_designation = '';
    public $prepared_group = '';

    // Taken Out By
    public $taken_name = '';
    public $taken_ic_no = '';
    public $taken_designation = '';
    public $taken_group = '';

    // Transport
    public $transport_mode = '';
    public $vehicle_no = '';

    // Destination
    public $destination = '';

    // Returnable only
    public $due_date = '';

    // Description
    public $description = '';

    public $materials = [];

    public $materialsMaster = [];

    public function mount()
    {
        $this->gate_pass_no =
            'GP-' . now()->format('YmdHis');

        $this->materialsMaster = Material::orderBy('material_name')
            ->get()
            ->toArray();

        $this->addMaterialRow();
    }

    public function addMaterialRow()
    {
        if (count($this->materials) >= 10) {
            return;
        }

        $this->materials[] = [
            'material_code' => '',
            'material_name' => '',
            'description' => '',
            'quantity' => 1,
            'unit' => '',
            'price' => '',
            'remarks' => '',
        ];
    }

    public function deleteMaterialRow($index)
    {
        unset($this->materials[$index]);

        $this->materials =
            array_values($this->materials);
    }

    public function updated($name, $value)
    {
        if (str_contains($name, 'material_code')) {

            $parts = explode('.', $name);

            $index = $parts[1];

            $material = Material::where(
                'material_code',
                $value
            )->first();

            if ($material) {

                $this->materials[$index]['material_name']
                    = $material->material_name;

                $this->materials[$index]['unit']
                    = $material->unit;
            }
        }
    }

    public function save()
    {
        $gatePass = GatePass::create([

            'gate_pass_no' => $this->gate_pass_no,

            'category' => $this->category,

            'created_by' => auth()->id(),

            'taken_by' => $this->taken_name,

            'destination' => $this->destination,

            'transport_mode' => $this->transport_mode,

            'due_date' =>
                $this->category == 'RETURNABLE'
                ? $this->due_date
                : null,

            'status' => 'PENDING_APPROVAL',
        ]);

        foreach ($this->materials as $material) {

            if (empty($material['material_code'])) {
                continue;
            }

            GatePassMaterial::create([

                'gate_pass_id' => $gatePass->id,

                'material_code' => $material['material_code'],

                'material_name' => $material['material_name'],

                'description' => $material['description'],

                'quantity' => $material['quantity'],

                'unit' => $material['unit'],

                'price' => $material['price'],

                'remarks' => $material['remarks'],
            ]);
        }

        session()->flash(
            'success',
            'Gate Pass Saved Successfully'
        );
    }

    public function render()
    {
        return view('livewire.gate-pass-table');
    }
}