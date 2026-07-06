<div class="max-w-7xl mx-auto">

    {{-- PAGE TITLE --}}
    <div class="bg-white shadow rounded p-4 mb-4">
        <h2 class="text-2xl font-bold">
            {{ $category == 'RETURNABLE'
                ? 'Returnable Material Gate Pass'
                : 'Non Returnable Material Gate Pass' }}
        </h2>
    </div>

    {{-- GATE PASS DETAILS --}}
    <div class="bg-white shadow rounded p-4 mb-4">

        <h3 class="font-bold text-lg mb-3">
            Gate Pass Details
        </h3>

        <table class="table-auto border w-full text-sm">

            <tr>
                <td class="border p-2 font-semibold">
                    Gate Pass No
                </td>

                <td class="border p-2">
                    {{ $gate_pass_no }}
                </td>

                <td class="border p-2 font-semibold">
                    Status
                </td>

                <td class="border p-2">
                    Pending Approval
                </td>
            </tr>

        </table>

    </div>

    {{-- PREPARED BY --}}
    <div class="bg-white shadow rounded p-4 mb-4">

        <h3 class="font-bold mb-3">
            Prepared By
        </h3>

        <table class="table-auto border w-3/4">

            <tr>
                <th class="border p-2">Name</th>
                <th class="border p-2">IC No</th>
                <th class="border p-2">Designation</th>
                <th class="border p-2">Group</th>
            </tr>

            <tr>
                <td class="border p-2">
                    <input type="text"
                        wire:model="prepared_name"
                        class="w-full border-0">
                </td>

                <td class="border p-2">
                    <input type="text"
                        wire:model="prepared_ic"
                        class="w-full border-0">
                </td>

                <td class="border p-2">
                    <input type="text"
                        wire:model="prepared_designation"
                        class="w-full border-0">
                </td>

                <td class="border p-2">
                    <input type="text"
                        wire:model="prepared_group"
                        class="w-full border-0">
                </td>
            </tr>

        </table>

    </div>

    {{-- TAKEN OUT BY --}}
    <div class="bg-white shadow rounded p-4 mb-4">

        <h3 class="font-bold mb-3">
            Taken Out By
        </h3>

        <table class="table-auto border w-3/4">

            <tr>
                <th class="border p-2">Name</th>
                <th class="border p-2">IC No</th>
                <th class="border p-2">Designation</th>
                <th class="border p-2">Group</th>
            </tr>

            <tr>
                <td class="border p-2">
                    <input type="text"
                        wire:model="taken_name"
                        class="w-full border-0">
                </td>

                <td class="border p-2">
                    <input type="text"
                        wire:model="taken_ic"
                        class="w-full border-0">
                </td>

                <td class="border p-2">
                    <input type="text"
                        wire:model="taken_designation"
                        class="w-full border-0">
                </td>

                <td class="border p-2">
                    <input type="text"
                        wire:model="taken_group"
                        class="w-full border-0">
                </td>
            </tr>

        </table>

    </div>

    {{-- TRANSPORT DETAILS --}}
    <div class="bg-white shadow rounded p-4 mb-4">

        <h3 class="font-bold mb-3">
            Transport Details
        </h3>

        <table class="table-auto border w-3/4">

            <tr>

                <td class="border p-2 font-semibold">
                    Destination
                </td>

                <td class="border p-2">
                    <input type="text"
                        wire:model="destination"
                        class="w-full border-0">
                </td>

            </tr>

            <tr>

                <td class="border p-2 font-semibold">
                    Transport Mode
                </td>

                <td class="border p-2">
                    <input type="text"
                        wire:model="transport_mode"
                        class="w-full border-0">
                </td>

            </tr>

            @if($category == 'RETURNABLE')

            <tr>

                <td class="border p-2 font-semibold">
                    Due Date
                </td>

                <td class="border p-2">
                    <input type="date"
                        wire:model="due_date"
                        class="w-full border">
                </td>

            </tr>

            @endif

        </table>

    </div>

    {{-- DESCRIPTION --}}
    <div class="bg-white shadow rounded p-4 mb-4">

        <h3 class="font-bold mb-3">
            Description
        </h3>

        <textarea
            wire:model="description"
            rows="4"
            class="w-full border rounded p-2">
        </textarea>

    </div>

    {{-- MATERIAL DETAILS --}}
    <div class="bg-white shadow rounded p-4">

        <div class="flex justify-between mb-3">

            <h3 class="font-bold">
                Material Details
            </h3>

            <button
                wire:click="addMaterialRow"
                class="bg-blue-600 text-black px-3 py-2 rounded">

                Add Material

            </button>

        </div>

        <table class="table-auto border w-full">

            <thead>

                <tr class="bg-gray-100">

                    <th class="border p-2">
                        Material Code
                    </th>

                    <th class="border p-2">
                        Material Name
                    </th>

                    <th class="border p-2">
                        Description
                    </th>

                    <th class="border p-2">
                        Qty
                    </th>

                    <th class="border p-2">
                        Unit
                    </th>

                    <th class="border p-2">
                        Price
                    </th>

                    <th class="border p-2">
                        Remarks
                    </th>

                    <th class="border p-2">
                        Action
                    </th>

                </tr>

            </thead>

            <tbody>

            @foreach($materials as $index => $material)

                <tr>

                    <td class="border p-2">
                        <input type="text"
                            wire:model="materials.{{ $index }}.material_code"
                            class="w-full">
                    </td>

                    <td class="border p-2">
                        <input type="text"
                            wire:model="materials.{{ $index }}.material_name"
                            class="w-full">
                    </td>

                    <td class="border p-2">
                        <input type="text"
                            wire:model="materials.{{ $index }}.description"
                            class="w-full"
                            placeholder="Description">
                    </td>

                    <td class="border p-2">
                        <input type="number"
                            wire:model="materials.{{ $index }}.quantity"
                            class="w-full">
                    </td>

                    <td class="border p-2">
                        <input type="text"
                            wire:model="materials.{{ $index }}.unit"
                            class="w-full">
                    </td>

                    <td class="border p-2">
                        <input type="number"
                            wire:model="materials.{{ $index }}.price"
                            class="w-full">
                    </td>

                    <td class="border p-2">
                        <input type="text"
                            wire:model="materials.{{ $index }}.remarks"
                            class="w-full">
                    </td>

                    <td class="border p-2 text-center">

                        <button
                            wire:click="deleteMaterialRow({{ $index }})"
                            class="bg-red-600 text-black px-2 py-1 rounded">

                            Delete

                        </button>

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>