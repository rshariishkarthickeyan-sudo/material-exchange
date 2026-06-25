<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GatePass extends Model
{
    protected $fillable = [
        'gate_pass_no',
        'category',
        'created_by',
        'approved_by',
        'security_by',
        'taken_by',
        'destination',
        'transport_mode',
        'due_date',
        'actual_return_date',
        'status',
        'remarks',
        'approval_date',
        'security_date'
    ];

    protected $casts = [
        'due_date' => 'date',
        'actual_return_date' => 'date',
        'approval_date' => 'datetime',
        'security_date' => 'datetime'
    ];

    public function materials()
    {
        return $this->hasMany(GatePassMaterial::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function security()
    {
        return $this->belongsTo(User::class, 'security_by');
    }
}