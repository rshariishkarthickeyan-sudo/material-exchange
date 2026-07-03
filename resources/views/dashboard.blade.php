<x-app-layout>

<div class="p-6">

    <h1 class="text-3xl font-bold mb-6">
        Material Management System
    </h1>

    {{-- Dashboard Cards --}}
    <div class="grid grid-cols-4 gap-4 mb-6">

        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-gray-600">Total Gate Passes</h3>
            <p class="text-2xl font-bold">
                {{ \App\Models\GatePass::count() }}
            </p>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-gray-600">Pending Approval</h3>
            <p class="text-2xl font-bold">
                {{ \App\Models\GatePass::where('status','PENDING_APPROVAL')->count() }}
            </p>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-gray-600">Released</h3>
            <p class="text-2xl font-bold">
                {{ \App\Models\GatePass::where('status','RELEASED')->count() }}
            </p>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-gray-600">Return Pending</h3>
            <p class="text-2xl font-bold">
                {{ \App\Models\GatePass::where('status','RETURN_PENDING')->count() }}
            </p>
        </div>

    </div>

    {{-- Gate Pass Section --}}
    <livewire:gate-pass-table />

    <div class="mt-8"></div>

    {{-- Material Master Section --}}
    <livewire:material-table />

</div>
```

</x-app-layout>
