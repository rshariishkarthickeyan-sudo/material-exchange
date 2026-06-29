<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\MaterialCategory;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    $categories =
        MaterialCategory::all();

    return view(
        'materials.create',
        compact('categories')
    );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    Material::create([

        'material_code' =>
            $request->material_code,

        'material_name' =>
            $request->material_name,

        'material_category_id' =>
            $request->material_category_id,

        'unit' =>
            $request->unit,

        'stock_quantity' =>
            $request->stock_quantity,

        'location' =>
            $request->location,

        'status' =>
            $request->status

    ]);

    return redirect()
            ->route('materials.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Material $material)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        //
    }
}
