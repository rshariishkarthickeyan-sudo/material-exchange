<?php

namespace App\Http\Controllers;

use App\Models\GatePass;
use Illuminate\Http\Request;

class GatePassController extends Controller
{
    public function index()
    {
    $gatepasses = GatePass::latest()->get();

    return view('gatepasses.index', compact('gatepasses'));
    }

    public function create()
    {
        return view('gatepasses.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'category' => 'required',
        'taken_by' => 'required',
        'destination' => 'required',
        'transport_mode' => 'required',
    ]);

    GatePass::create([
        'gate_pass_no' => 'GP-' . time(),
        'category' => $request->category,
        'created_by' => auth()->id(),
        'taken_by' => $request->taken_by,
        'destination' => $request->destination,
        'transport_mode' => $request->transport_mode,
        'due_date' => $request->due_date,
        'remarks' => $request->remarks,
        'status' => 'PENDING_APPROVAL',
    ]);

    return redirect()
        ->route('gatepasses.index')
        ->with('success', 'Gate Pass Created Successfully');
}

    public function show(GatePass $gatepass)
    {
        return view('gatepasses.show', compact('gatepass'));
    }

    public function edit(GatePass $gatepass)
    {
        return view('gatepasses.edit', compact('gatepass'));
    }

    public function update(Request $request, GatePass $gatepass)
    {
        $gatepass->update($request->all());

        return redirect()->route('gatepasses.index')
            ->with('success', 'Gate Pass Updated Successfully');
    }

    public function destroy(GatePass $gatepass)
    {
        $gatepass->delete();

        return redirect()->route('gatepasses.index')
            ->with('success', 'Gate Pass Deleted Successfully');
    }
}