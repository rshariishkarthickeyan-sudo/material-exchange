<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\GatePass;
use App\Models\GatePassMaterial;
use App\Models\Material;

class GatePassTable extends Component
{
    public $gatepasses = [];


    public $category = 'RETURNABLE';

    public $taken_by = '';

    public $destination = '';

    public $transport_mode = '';

    public $due_date = '';

    public $materials = [];

    public $materialsMaster = [];

    public function mount()
    {
    $this->materialsMaster = Material::orderBy('material_name')
        ->get()
        ->toArray();

    $this->addRow();
    }

    public function addRow()
{
    $this->gatepasses[] = [
    'gate_pass_no' => 'GP-' . now()->format('YmdHis'),
    'category' => 'RETURNABLE',
    'taken_by' => '',
    'destination' => '',
    'transport_mode' => '',
    'due_date' => null,
    'status' => 'PENDING_APPROVAL',

    'materials' => [
        [
            'material_code' => '',
            'material_name' => '',
            'quantity' => 1,
            'unit' => '',
            'remarks' => '',
        ]
    ]
];
}

public function deleteRow($index)
{
    unset($this->gatepasses[$index]);

    $this->gatepasses =
        array_values($this->gatepasses);
}

    public function addMaterialRow($gpIndex)
{
    if (
        count(
            $this->gatepasses[$gpIndex]['materials']
        ) >= 10
    ) {
        return;
    }

    $this->gatepasses[$gpIndex]['materials'][] = [

        'material_code' => '',

        'material_name' => '',

        'quantity' => 1,

        'unit' => '',

        'remarks' => '',
    ];
}

    public function deleteMaterialRow(
    $gpIndex,
    $matIndex
)
    {
    unset(
        $this->gatepasses[$gpIndex]
        ['materials'][$matIndex]
    );

    $this->gatepasses[$gpIndex]
    ['materials'] = array_values(
        $this->gatepasses[$gpIndex]
        ['materials']
    );
    }

    public function updatedMaterials($value, $name)
    {
        $parts = explode('.', $name);

        if (
            count($parts) == 2 &&
            $parts[1] == 'material_code'
        ) {
            $index = $parts[0];

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
    foreach ($this->gatepasses as $gp) {

        $gatePass = GatePass::create([

            'gate_pass_no' =>
                $gp['gate_pass_no'],

            'category' =>
                $gp['category'],

            'created_by' =>
                auth()->id(),

            'taken_by' =>
                $gp['taken_by'],

            'destination' =>
                $gp['destination'],

            'transport_mode' =>
                $gp['transport_mode'],

            'due_date' =>
                $gp['due_date'] ?: null,

            'status' =>
                'PENDING_APPROVAL',
        ]);

        foreach (
            $gp['materials']
            as $material
        ) {

            if (
                empty(
                    $material['material_code']
                )
            ) {
                continue;
            }

            GatePassMaterial::create([

                'gate_pass_id' =>
                    $gatePass->id,

                'material_code' =>
                    $material['material_code'],

                'material_name' =>
                    $material['material_name'],

                'quantity' =>
                    $material['quantity'],

                'unit' =>
                    $material['unit'],

                'remarks' =>
                    $material['remarks'],
            ]);
        }
    }

    session()->flash(
        'success',
        'Saved Successfully'
    );
}
    

    public function resetForm()
    {
        $this->gate_pass_no =
            'GP-' . now()->format('YmdHis');

        $this->category = 'RETURNABLE';

        $this->taken_by = '';

        $this->destination = '';

        $this->transport_mode = '';

        $this->due_date = '';

        $this->materials = [];

        $this->addMaterialRow();
    }

    public function render()
    {
        return view('livewire.gate-pass-table');
    }
}