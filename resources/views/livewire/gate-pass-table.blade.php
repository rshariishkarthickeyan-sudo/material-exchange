<div>
    
    <div class="bg-white p-6 rounded shadow">

    <div class="flex justify-between mb-4">
        <h2 class="text-xl font-bold">Gate Pass Management</h2>

        <button
            wire:click="addRow"
            class="bg-blue-600 text-black px-4 py-2 rounded">
            Add Gate Pass
        </button>
    </div>

    @foreach($gatepasses as $gpIndex => $gatepass)

    <div class="border rounded mb-4">
        <h3 class="font-bold text-lg mb-2">
        Gate Pass {{ $gpIndex + 1 }}
        </h3>

        {{-- Gate Pass Row --}}
        <table class="w-full border">

            <thead>

                <tr class="bg-gray-100">

                    <th class="border p-2">Category</th>
                    <th class="border p-2">Taken By</th>
                    <th class="border p-2">Destination</th>
                    <th class="border p-2">Transport</th>
                    <th class="border p-2">Due Date</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Action</th>

                </tr>

            </thead>

            <tbody>

                <tr>

                    <td class="border p-2">

                        <select
                            wire:model="gatepasses.{{ $gpIndex }}.category"
                            class="w-full border">

                            <option value="RETURNABLE">
                                Returnable
                            </option>

                            <option value="NON_RETURNABLE">
                                Non Returnable
                            </option>

                        </select>

                    </td>

                    <td class="border p-2">
                        <input
                            type="text"
                            wire:model="gatepasses.{{ $gpIndex }}.taken_by"
                            class="w-full border">
                    </td>

                    <td class="border p-2">
                        <input
                            type="text"
                            wire:model="gatepasses.{{ $gpIndex }}.destination"
                            class="w-full border">
                    </td>

                    <td class="border p-2">
                        <input
                            type="text"
                            wire:model="gatepasses.{{ $gpIndex }}.transport_mode"
                            class="w-full border">
                    </td>

                    <td class="border p-2">

                        @if(($gatepass['category'] ?? '') == 'RETURNABLE')

                            <input
                                type="date"
                                wire:model="gatepasses.{{ $gpIndex }}.due_date"
                                class="w-full border">

                        @endif

                    </td>

                    <td class="border p-2">

                        <select
                            wire:model="gatepasses.{{ $gpIndex }}.status"
                            class="w-full border">

                            <option value="PENDING_APPROVAL">
                                Pending Approval
                            </option>

                            <option value="APPROVED">
                                Approved
                            </option>

                        </select>

                    </td>

                    <td class="border p-2 text-center">

                        <button
                            wire:click="deleteRow({{ $gpIndex }})"
                            class="bg-red-600 text-white px-3 py-1 rounded">

                            Delete Row

                        </button>

                    </td>

                </tr>

            </tbody>

        </table>

        {{-- Add Material Link --}}
        <div class="p-2">

            <button
                wire:click="addMaterialRow({{ $gpIndex }})"
                class="text-blue-600">

                + Add Material

            </button>

        </div>

        {{-- Material Table --}}
        <table class="w-full border">

            <thead>

                <tr class="bg-gray-100">

                    <th class="border p-2">Material Code</th>
                    <th class="border p-2">Material Name</th>
                    <th class="border p-2">Qty</th>
                    <th class="border p-2">Unit</th>
                    <th class="border p-2">Remarks</th>
                    <th class="border p-2">Action</th>

                </tr>

            </thead>

            <tbody>

            @foreach($gatepass['materials'] as $matIndex => $material)

                <tr>

                    <td class="border p-2">

                        <select
                            wire:model.live="gatepasses.{{ $gpIndex }}.materials.{{ $matIndex }}.material_code"
                            class="w-full border">

                            <option value="">
                                Select
                            </option>

                            @foreach($materialsMaster as $master)

                                <option value="{{ $master['material_code'] }}">
                                    {{ $master['material_code'] }}
                                </option>

                            @endforeach

                        </select>

                    </td>

                    <td class="border p-2">
                        {{ $material['material_name'] ?? '' }}
                    </td>

                    <td class="border p-2">

                        <input
                            type="number"
                            wire:model="gatepasses.{{ $gpIndex }}.materials.{{ $matIndex }}.quantity"
                            class="w-full border">

                    </td>

                    <td class="border p-2">
                        {{ $material['unit'] ?? '' }}
                    </td>

                    <td class="border p-2">

                        <input
                            type="text"
                            wire:model="gatepasses.{{ $gpIndex }}.materials.{{ $matIndex }}.remarks"
                            class="w-full border">

                    </td>

                    <td class="border p-2 text-center">

                        <button
                            wire:click="deleteMaterialRow({{ $gpIndex }}, {{ $matIndex }})"
                            class="bg-red-600 text-white px-3 py-1 rounded">

                            Delete

                        </button>

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

    @endforeach

    <button
        wire:click="save"
        class="bg-green-600 text-black px-5 py-2 rounded">

        Save All Gate Passes

    </button>

    </div>
</div>