<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\GatePass;

class GatePassTable extends Component
{
    public $gatepasses = [];

    public function mount()
    {
        $this->gatepasses = GatePass::all()->toArray();
    }

    public function addRow()
    {
        $this->gatepasses[] = [
            'id' => null,
            'category' => 'RETURNABLE',
            'taken_by' => '',
            'destination' => '',
            'transport_mode' => '',
        ];
    }

    public function save()
    {
        foreach ($this->gatepasses as $row) {

            GatePass::updateOrCreate(
                ['id' => $row['id'] ?? null],
                [
                    'gate_pass_no' => $row['gate_pass_no'] ?? ('GP-' . time() . rand(100,999)),
                    'category' => $row['category'],
                    'created_by' => auth()->id(),
                    'taken_by' => $row['taken_by'],
                    'destination' => $row['destination'],
                    'transport_mode' => $row['transport_mode'],
                    'status' => 'PENDING_APPROVAL',
                ]
            );
        }

        session()->flash('success', 'Saved successfully');

        $this->gatepasses = GatePass::all()->toArray();
    }

    public function deleteRow($index)
    {
        if (!empty($this->gatepasses[$index]['id'])) {
            GatePass::find($this->gatepasses[$index]['id'])?->delete();
        }

        unset($this->gatepasses[$index]);

        $this->gatepasses = array_values($this->gatepasses);
    }

    public function render()
    {
        return view('livewire.gate-pass-table');
    }
}