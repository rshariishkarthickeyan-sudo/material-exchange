<?php

use App\Http\Controllers\MaterialCategoryController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GatePassController;
use App\Http\Controllers\DepartmentController;
use App\Models\GatePass;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    $recentGatePasses = GatePass::latest()
    ->take(5)
    ->get();

    $totalGatePasses = GatePass::count();

    $pendingApproval = GatePass::where(
        'status',
        'PENDING_APPROVAL'
    )->count();

    $approved = GatePass::where(
        'status',
        'APPROVED'
    )->count();

    $released = GatePass::where(
        'status',
        'RELEASED'
    )->count();

    $returned = GatePass::where(
        'status',
        'RETURNED'
    )->count();

    $overdue = GatePass::where(
        'category',
        'RETURNABLE'
    )
    ->where('status', '!=', 'RETURNED')
    ->whereDate('due_date', '<', now())
    ->count();

    $dueTomorrow = GatePass::where('category', 'RETURNABLE')
    ->where('status', '!=', 'RETURNED')
    ->whereDate('due_date', now()->addDay())
    ->count();

    return view('dashboard', compact(
    'totalGatePasses',
    'pendingApproval',
    'approved',
    'released',
    'returned',
    'overdue',
    'recentGatePasses',
    'pendingApproval',
    'overdue',
    'dueTomorrow',
    ));

    $pendingApproval = GatePass::where(
    'status',
    'PENDING_APPROVAL'
)->count();

$overdueMaterials = GatePass::where(
    'category',
    'RETURNABLE'
)
->where('status', '!=', 'RETURNED')
->whereDate('due_date', '<', now())
->count();

$dueTomorrow = GatePass::where(
    'category',
    'RETURNABLE'
)
->where('status', '!=', 'RETURNED')
->whereDate('due_date', now()->addDay()->toDateString())
->count();

})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::resource('departments', DepartmentController::class);

    Route::resource(
        'materials',
        MaterialController::class
    );

    Route::resource(
        'material-categories',
        MaterialCategoryController::class
    );

    Route::resource(
        'gatepasses',
        GatePassController::class
    );

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
    
    Route::get('/gatepass/returnable', function () {
    return view('gatepass.returnable');
    })->middleware('auth');

    Route::get('/gatepass/non-returnable', function () {
    return view('gatepass.nonreturnable');
    })->middleware('auth');    

    Route::get('/materials/returnable', function () {
    return view('materials.returnable');
    });

    Route::get('/materials/non-returnable', function () {
    return view('materials.non-returnable');
    });

    Route::get('/pending-approval-report', function () {

    $gatepasses = \App\Models\GatePass::where(
        'status',
        'PENDING_APPROVAL'
    )->latest()->get();

    return view(
        'gatepasses.report',
        compact('gatepasses')
    );

})->middleware(['auth'])->name('pending.approval.report');

    Route::get('/gatepass/view/{id}', function ($id) {

    $gatepass = \App\Models\GatePass::with('materials')
        ->findOrFail($id);

    return view(
        'gatepasses.view',
        compact('gatepass')
    );

    })->name('gatepass.report.view');


Route::post('/gatepass/approval/{id}', function (
    Request $request,
    $id
    ) {

    $gatepass = GatePass::findOrFail($id);

    $gatepass->update([

        'status' => $request->input('action'),

        'approver_remarks' =>
            $request->input('approver_remarks'),

        'approved_by' =>
            auth()->id(),

        'approval_date' =>
            now(),
    ]);

    return redirect()
        ->route('gatepass.report');

    })->name('gatepass.approval');

Route::get('/security-report', function () {

    $gatepasses = \App\Models\GatePass::where(
        'status',
        'APPROVED'
    )->latest()->get();

    return view(
        'gatepasses.security-report',
        compact('gatepasses')
    );

    })->name('security.report');

Route::get('/security/view/{id}', function ($id) {

    $gatepass = \App\Models\GatePass::with('materials')
        ->findOrFail($id);

    return view(
        'gatepasses.security-view',
        compact('gatepass')
    );

    })->name('security.view');

Route::post('/security/release/{id}', function (
    Request $request,
    $id
) {

    $gatepass = \App\Models\GatePass::findOrFail($id);

    $gatepass->update([

        'status' => 'RELEASED',

        'security_remarks' =>
            $request->input('security_remarks'),

        'security_by' =>
            auth()->id(),

        'security_date' =>
            now(),

    ]);

    return redirect()
        ->route('security.report');

    })->name('security.release');

Route::get('/released-material-report', function () {

    $gatepasses = \App\Models\GatePass::where(
        'status',
        'RELEASED'
    )->latest()->get();

    return view(
        'gatepasses.released-report',
        compact('gatepasses')
    );

    })->name('released.report');

Route::get('/returnable-material-report', function () {

    $gatepasses = GatePass::where(
        'category',
        'RETURNABLE'
    )->latest()->get();

    return view(
        'gatepasses.returnable-report',
        compact('gatepasses')
    );

    })->name('returnable.report');

Route::get('/non-returnable-material-report', function () {

    $gatepasses = GatePass::where(
        'category',
        'NON_RETURNABLE'
    )->latest()->get();

    return view(
        'gatepasses.nonreturnable-report',
        compact('gatepasses')
    );

    })->name('nonreturnable.report');

Route::get('/return-pending-report', function () {

    $gatepasses = GatePass::where(
        'category',
        'RETURNABLE'
    )
    ->where('status', 'RELEASED')
    ->whereNull('returned_date')
    ->latest()
    ->get();

    return view(
        'gatepasses.return-pending-report',
        compact('gatepasses')
    );

    })->name('return.pending.report');

Route::get('/return/view/{id}', function ($id) {

    $gatepass = \App\Models\GatePass::with('materials')
        ->findOrFail($id);

    return view(
        'gatepasses.return-view',
        compact('gatepass')
    );

    })->name('return.view');

Route::post('/return/submit/{id}', function (
    Request $request,
    $id
) {

    $gatepass = \App\Models\GatePass::findOrFail($id);

    $gatepass->status = 'RETURNED';
$gatepass->returned_date = today();
$gatepass->returned_by = auth()->id();
$gatepass->return_remarks = $request->return_remarks;

$gatepass->save();
return redirect()
    ->route('return.pending.report');

    })->name('return.submit');

Route::get('/returned-material-report', function () {

    $gatepasses = \App\Models\GatePass::where(
        'status',
        'RETURNED'
    )->latest()->get();

    return view(
        'gatepasses.returned-report',
        compact('gatepasses')
    );

    })->name('returned.report');

Route::get('/returned/view/{id}', function ($id) {

    $gatepass = \App\Models\GatePass::with('materials')
        ->findOrFail($id);

    return view(
        'gatepasses.returned-view',
        compact('gatepass')
    );

    })->name('returned.view');

Route::get('/report/view/{id}', function ($id) {

    $gatepass = \App\Models\GatePass::with('materials')
        ->findOrFail($id);

    return view(
        'gatepasses.report-view',
        compact('gatepass')
    );

    })->name('report.view');


Route::get(
    '/gatepass/edit/{id}',
    \App\Livewire\GatePassTable::class
    )->name('gatepass.edit');

Route::get('/gatepass/view/{id}', [GatePassController::class, 'view'])
    ->name('gatepass.view');

Route::get(
    '/gatepass/{id}/approval-view',
    [GatePassController::class, 'approvalView']
    )->name('gatepass.approval-view');

Route::get('/overdue-materials-report', function () {

    $gatepasses = \App\Models\GatePass::where('category', 'RETURNABLE')
        ->where('status', '!=', 'RETURNED')
        ->whereDate('due_date', '<', today())
        ->get();

    return view(
        'gatepasses.overdue-report',
        compact('gatepasses')
    );

})->name('overdue.report');

Route::get('/due-tomorrow-report', function () {

    $gatepasses = \App\Models\GatePass::where('category', 'RETURNABLE')
        ->where('status', '!=', 'RETURNED')
        ->whereDate('due_date', today()->addDay())
        ->get();

    return view(
        'gatepasses.due-tomorrow-report',
        compact('gatepasses')
    );

})->name('due.tomorrow.report');


});

require __DIR__.'/auth.php';