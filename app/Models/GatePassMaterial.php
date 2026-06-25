<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GatePassMaterial extends Model
{
    protected $fillable = [
        'gate_pass_id',
        'material_code',
        'material_name',
        'quantity',
        'unit',
        'remarks'
    ];

    public function gatePass()
    {
        return $this->belongsTo(GatePass::class);
    }
}