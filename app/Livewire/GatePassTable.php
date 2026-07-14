<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\GatePass;
use App\Models\GatePassMaterial;
use App\Models\Material;
use App\Models\User;

class GatePassTable extends Component
{

    public $authority_id = '';
    public $authority_name = '';
    public $authority_ic_no = '';
    public $authority_designation = '';
    public $authority_group = '';
    public $authorities = [];

    public $gate_pass_no;

    public $category = 'RETURNABLE';
    public $savedGatePassId = null;

    public $editing = false;
    public $gatePassId;

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

    
    public $selected_authority = '';

    public function mount($category = 'RETURNABLE', $id = null)
    {
        
        $this->category = $category;
        $user = auth()->user();
    
    $this->prepared_name = $user->name;
    $this->prepared_ic_no = $user->id;
    $this->prepared_designation = $user->desig;
    $this->prepared_group = $user->group;
        $this->gate_pass_no =
            'GP-' . now()->format('YmdHis');

        $this->materialsMaster = Material::orderBy('material_name')
            ->get()
            ->toArray();

        $this->authorities = User::where('role', 'authority')->get();

        $this->addMaterialRow();
    if ($id) {

    $this->editing = true;

    $gatePass = GatePass::with('materials')
        ->findOrFail($id);

    $this->gatePassId = $gatePass->id;

    $this->gate_pass_no =
    'GP-' . now()->format('YmdHis');

    $this->category = $gatePass->category;

    $this->taken_name = $gatePass->taken_name;

    $this->destination = $gatePass->destination;

    $this->transport_mode = $gatePass->transport_mode;

    $this->due_date = $gatePass->due_date;

    $this->materials = [];

    foreach ($gatePass->materials as $material) {

        $this->materials[] = [

            'material_code' => $material->material_code,

            'material_name' => $material->material_name,

            'description' => $material->description,

            'quantity' => $material->quantity,

            'unit' => $material->unit,

            'price' => $material->price,

            'remarks' => $material->remarks,

        ];
    }

    return;
}
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
    $this->validate([
        'taken_name' => 'required',
        'destination' => 'required',
        'transport_mode' => 'required',
        'due_date' => 'required_if:category,RETURNABLE|date',
    ]);

    $authority = User::find($this->authority_id);

    $gatePass = GatePass::create([

        'gate_pass_no' => 'GP-' . now()->format('YmdHis') . rand(100,999),

        'category' => $this->category,

        'created_by' => auth()->id(),

        // Prepared By
        'prepared_name' => $this->prepared_name,
        'prepared_ic_no' => $this->prepared_ic_no,
        'prepared_designation' => $this->prepared_designation,
        'prepared_group' => $this->prepared_group,

        // Taken Out By
        'taken_name' => $this->taken_name,
        'taken_ic_no' => $this->taken_ic_no,
        'taken_designation' => $this->taken_designation,
        'taken_group' => $this->taken_group,

        // Authority
        'authority_name' => $authority?->name,
        'authority_ic_no' => $authority?->id,
        'authority_designation' => $authority?->desig,
        'authority_group' => $authority?->group,

        // Transport
        'destination' => $this->destination,
        'transport_mode' => $this->transport_mode,
        'vehicle_no' => $this->vehicle_no,

        // Description
        'description' => $this->description,

        // Returnable
        'due_date' => $this->category == 'RETURNABLE'
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
        'Gate Pass Submitted Successfully'
    );

    $this->savedGatePassId = $gatePass->id;
}


public function update()
{
    $gatePass = GatePass::findOrFail($this->gatePassId);

    $gatePass->update([

        'taken_name' => $this->taken_name,

        'destination' => $this->destination,

        'transport_mode' => $this->transport_mode,

        'due_date' => $this->due_date,

    ]);

    GatePassMaterial::where(
        'gate_pass_id',
        $gatePass->id
    )->delete();

    foreach ($this->materials as $material) {

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
        'Gate Pass Updated Successfully'
    );
}


  public function updatedAuthorityId($value)
{
    $authority = User::find($value);

    if ($authority) {
        
        $this->authority_name = $authority->name;
        $this->authority_ic_no = $authority->id;

        $this->authority_designation =
            $authority->desig ?? '';

        $this->authority_group =
            $authority->group ?? '';
    }
}

    public function render()
    {
        return view('livewire.gate-pass-table');
    }
}