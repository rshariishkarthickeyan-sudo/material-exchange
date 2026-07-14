<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GatePass extends Model
{

    protected $fillable = [

    'category',

    'created_by',
    'approved_by',
    'security_by',

    'approver_remarks',
    'security_remarks',

    'status',

    // Prepared By
    'prepared_name',
    'prepared_ic_no',
    'prepared_designation',
    'prepared_group',

    // Taken Out By
    'taken_name',
    'taken_ic_no',
    'taken_designation',
    'taken_group',
    'taken_by',

    // Authority
    'authority_name',
    'authority_ic_no',
    'authority_designation',
    'authority_group',

    // Security
    'security_name',
    'security_ic_no',
    'security_designation',
    'security_group',

    'vehicle_no',
    'destination',
    'transport_mode',

    'description',

    'due_date',
    'actual_return_date',

    'remarks',
    'approval_date',
    'security_date',
];

    protected $casts = [
        'due_date' => 'date',
        'actual_return_date' => 'date',
        'approval_date' => 'datetime',
        'security_date' => 'datetime',
        'returned_date' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function materials()
    {
        return $this->hasMany(GatePassMaterial::class,'gate_pass_id');
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

    public function returnedUser()
    {
    return $this->belongsTo(User::class, 'returned_by');
    }
}