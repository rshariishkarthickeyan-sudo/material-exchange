<?php

use App\Http\Controllers\MaterialCategoryController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GatePassController;
use App\Http\Controllers\DepartmentController;
use App\Models\GatePass;
use Illuminate\Http\Request;

Route::get('/', function () {

    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return view('welcome');

})->middleware('prevent-back-history')
  ->name('home');

Route::get('/dashboard', function () {

    $totalGatePasses = GatePass::count();

    $pendingApproval = GatePass::where('status', 'PENDING_APPROVAL')->count();

    $approved = GatePass::where('status', 'APPROVED')->count();

    $released = GatePass::where('status', 'RELEASED')->count();

    $returned = GatePass::where('status', 'RETURNED')->count();

    $overdue = GatePass::where('status', 'RETURN_PENDING')
        ->whereDate('due_date', '<', now())
        ->count();

    $dueTomorrow = GatePass::where('status', 'RETURN_PENDING')
        ->whereDate('due_date', now()->addDay()->toDateString())
        ->count();

    $recentGatePasses = GatePass::latest()
        ->take(5)
        ->get();

    return view('dashboard', compact(
        'totalGatePasses',
        'pendingApproval',
        'approved',
        'released',
        'returned',
        'overdue',
        'dueTomorrow',
        'recentGatePasses'
    ));

})->middleware(['auth', 'prevent-back-history'])
  ->name('dashboard');

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->name('register');
});
});

Route::middleware(['auth','prevent-back-history'])->group(function () {

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

})->middleware(['auth','role:authority'])
  ->name('pending.approval.report');

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

    })->middleware(['auth','role:security'])
    ->name('security.report');

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

    })->middleware(['auth','role:admin'])
    ->name('returnable.report');

Route::get('/non-returnable-material-report', function () {

    $gatepasses = GatePass::where(
        'category',
        'NON_RETURNABLE'
    )->latest()->get();

    return view(
        'gatepasses.nonreturnable-report',
        compact('gatepasses')
    );

    })->middleware(['auth','role:admin'])
    ->name('nonreturnable.report');

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

    })->middleware(['auth','role:admin'])
    ->name('return.pending.report');

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

    })->middleware(['auth','role:admin'])
    ->name('returned.report');

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

})->middleware(['auth','role:admin'])
->name('overdue.report');

Route::get('/due-tomorrow-report', function () {

    $gatepasses = \App\Models\GatePass::where('category', 'RETURNABLE')
        ->where('status', '!=', 'RETURNED')
        ->whereDate('due_date', today()->addDay())
        ->get();

    return view(
        'gatepasses.due-tomorrow-report',
        compact('gatepasses')
    );

})->middleware(['auth','role:admin'])
->name('due.tomorrow.report');

Route::get('/dashboard', function () {

    $role = auth()->user()->role;

    // Admin sees full dashboard
    if ($role == 'admin') {

        $totalGatePasses = GatePass::count();

        $pendingApproval = GatePass::where('status', 'PENDING_APPROVAL')->count();

        $approved = GatePass::where('status', 'APPROVED')->count();

        $released = GatePass::where('status', 'RELEASED')->count();

        $returned = GatePass::where('status', 'RETURNED')->count();

        $overdue = GatePass::where('status', 'RETURN_PENDING')
            ->whereDate('due_date', '<', now())
            ->count();

        $dueTomorrow = GatePass::where('status', 'RETURN_PENDING')
            ->whereDate('due_date', now()->addDay()->toDateString())
            ->count();

        $recentGatePasses = GatePass::latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalGatePasses',
            'pendingApproval',
            'approved',
            'released',
            'returned',
            'overdue',
            'dueTomorrow',
            'recentGatePasses'
        ));
    }

    // Authority
    if ($role == 'authority') {
        return redirect()->route('pending.approval.report');
    }

    // Security
    if ($role == 'security') {
        return redirect()->route('security.report');
    }

    // Employee
    if ($role == 'employee') {
        return redirect()->route('gatepasses.index');
    }

})->middleware(['auth','prevent-back-history'])
  ->name('dashboard');

Route::get('/employee/dashboard', function () {

    $totalGatePasses = GatePass::where(
        'created_by',
        auth()->id()
    )->count();

    $pendingApproval = GatePass::where(
        'created_by',
        auth()->id()
    )->where('status', 'PENDING_APPROVAL')->count();

    $approved = GatePass::where(
        'created_by',
        auth()->id()
    )->where('status', 'APPROVED')->count();

    $released = GatePass::where(
        'created_by',
        auth()->id()
    )->where('status', 'RELEASED')->count();

    $returned = GatePass::where(
        'created_by',
        auth()->id()
    )->where('status', 'RETURNED')->count();

    $overdue = GatePass::where(
        'created_by',
        auth()->id()
    )->where('status', 'RETURN_PENDING')
     ->whereDate('due_date', '<', now())
     ->count();

    $dueTomorrow = GatePass::where(
        'created_by',
        auth()->id()
    )->where('status', 'RETURN_PENDING')
     ->whereDate('due_date', now()->addDay())
     ->count();

    $recentGatePasses = GatePass::where(
        'created_by',
        auth()->id()
    )->latest()
     ->take(5)
     ->get();

    return view('dashboard', compact(
        'totalGatePasses',
        'pendingApproval',
        'approved',
        'released',
        'returned',
        'overdue',
        'dueTomorrow',
        'recentGatePasses'
    ));

})->middleware(['auth','prevent-back-history'])
  ->name('employee.dashboard');

Route::get('/authority/dashboard', function () {

    $gatepasses = GatePass::where(
        'status',
        'PENDING_APPROVAL'
    )->latest()->get();

    return view(
        'authority-dashboard',
        compact('gatepasses')
    );

})->name('authority.dashboard');

Route::get('/security/dashboard', function () {

    $totalGatePasses = GatePass::where(
        'status',
        'APPROVED'
    )->count();

    $pendingApproval = 0;

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
        'status',
        'RETURN_PENDING'
    )->whereDate('due_date', '<', now())
     ->count();

    $dueTomorrow = GatePass::where(
        'status',
        'RETURN_PENDING'
    )->whereDate('due_date', now()->addDay())
     ->count();

    $recentGatePasses = GatePass::where(
        'status',
        'APPROVED'
    )->latest()
     ->take(5)
     ->get();

    return view('dashboard', compact(
        'totalGatePasses',
        'pendingApproval',
        'approved',
        'released',
        'returned',
        'overdue',
        'dueTomorrow',
        'recentGatePasses'
    ));

})->middleware(['auth','prevent-back-history'])
  ->name('security.dashboard');

Route::get('/admin/dashboard', function () {

    $totalGatePasses = GatePass::count();

    $pendingApproval = GatePass::where('status', 'PENDING_APPROVAL')->count();

    $approved = GatePass::where('status', 'APPROVED')->count();

    $released = GatePass::where('status', 'RELEASED')->count();

    $returned = GatePass::where('status', 'RETURNED')->count();

    $overdue = GatePass::where('status', 'RETURN_PENDING')
        ->whereDate('due_date', '<', now())
        ->count();

    $dueTomorrow = GatePass::where('status', 'RETURN_PENDING')
        ->whereDate('due_date', now()->addDay())
        ->count();

    $recentGatePasses = GatePass::latest()
        ->take(5)
        ->get();

    return view('dashboard', compact(
        'totalGatePasses',
        'pendingApproval',
        'approved',
        'released',
        'returned',
        'overdue',
        'dueTomorrow',
        'recentGatePasses'
    ));

})->middleware(['auth','prevent-back-history'])
  ->name('admin.dashboard');

Route::middleware(['auth'])->group(function () {

    Route::get('/employee-dashboard', function () {
        return view('employee-dashboard');
    })->name('employee.dashboard');

    Route::get('/authority-dashboard', function () {
        return view('authority-dashboard');
    })->name('authority.dashboard');

    Route::get('/security-dashboard', function () {
        return view('security-dashboard');
    })->name('security.dashboard');

    Route::get('/admin-dashboard', function () {
        return view('admin-dashboard');
    })->name('admin.dashboard');

});


});

require __DIR__.'/auth.php';