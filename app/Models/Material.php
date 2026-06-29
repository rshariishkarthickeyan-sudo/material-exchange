<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [

        'material_code',

        'material_name',

        'material_category_id',

        'unit',

        'stock_quantity',

        'location',

        'status'

    ];

    public function category()
    {
        return $this->belongsTo(
            MaterialCategory::class,
            'material_category_id'
        );
    }
}