<div id="gate-pass-content">
    <div class="max-w-7xl mx-auto">

    {{-- PAGE TITLE --}}


    @if(session()->has('success'))

    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">

        {{ session('success') }}

    </div>

    @endif

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
                {{ $gatePassId }}
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
                        readonly
                        class="w-full border-0">
                </td>

                <td class="border p-2">
                    <input type="text"
                        wire:model="prepared_ic_no"
                        readonly
                        class="w-full border-0">
                </td>

                <td class="border p-2">
                    <input type="text"
                        wire:model="prepared_designation"
                        readonly
                        class="w-full border-0">
                </td>

                <td class="border p-2">
                    <input type="text"
                        wire:model="prepared_group"
                        readonly
                        class="w-full border-0">
                </td>
            </tr>

        </table>

    </div>

    <div class="flex items-start gap-4 mb-4">

    <!-- Approving Authority Box -->
    <div class="bg-white shadow rounded p-4 flex-1">

        <h3 class="font-bold mb-3">
            Approving Authority
        </h3>

        <table class="table-auto border w-full">

            <tr>
                <th class="border p-2">IC No</th>
                <th class="border p-2">Designation</th>
                <th class="border p-2">Group</th>
            </tr>

            <tr>
                <td class="border p-2">
                    {{ $authority_ic_no }}
                </td>

                <td class="border p-2">
                    {{ $authority_designation }}
                </td>

                <td class="border p-2">
                    {{ $authority_group }}
                </td>
            </tr>

        </table>

    </div>

    <!-- Separate Dropdown Box -->
    <div class="bg-white shadow rounded p-4 min-w-[250px]">

        <label class="font-semibold block mb-2">
            Select Authority
        </label>

        <select
            wire:model.live="authority_id"
            class="border rounded w-full p-2">

            <option value="">
                Choose Authority
            </option>

            @foreach($authorities as $authority)

                <option value="{{ $authority->id }}">
                    {{ $authority->name }}
                </option>

            @endforeach

        </select>

    </div>

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
                        wire:model.live="taken_name"
                        class="w-full border-0">
                </td>

                <td class="border p-2">
                    <input type="text"
                        wire:model="taken_ic_no"
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
                        wire:model.live="destination"
                        class="w-full border-0">
                </td>

            </tr>

            <tr>
            <td class="border p-2 font-semibold">
                Transport Mode
            </td>

            <td class="border p-2">
                <select wire:model.live="transport_mode"
                    class="w-full border rounded">

                    <option value="">Select</option>

                    <option value="Company Vehicle">
                        Company Vehicle
                    </option>

                    <option value="Own Vehicle">
                        Own Vehicle
                    </option>

                </select>
            </td>
        </tr>
        @if($transport_mode == 'Own Vehicle')

        <tr>
            <td class="border p-2 font-semibold">
                Vehicle No
            </td>

            <td class="border p-2">
                <input type="text"
                    wire:model.live="vehicle_no"
                    class="w-full border-0">
            </td>
        </tr>

        @endif
            @if($category == 'RETURNABLE')

            <tr>

                <td class="border p-2 font-semibold">
                    Due Date
                </td>

                <td class="border p-2">
                    <input type="date"
                        wire:model.live="due_date"
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

  <div id="action-buttons" class="mt-6 text-center">

    @if($editing)

    <button
        wire:click="update"
        class="bg-yellow-600 text-white px-6 py-3 rounded shadow">

        Update

    </button>

@else

    <button
        wire:click="save"
        class="bg-green-600 text-white px-6 py-3 rounded shadow">

        Submit

    </button>

@endif

    <button
        type="button"
        onclick="printGatePass()"
        class="bg-blue-600 text-white px-6 py-3 rounded shadow ml-3">

        Print Gate Pass

    </button>

</div>
    <script>
function printGatePass() {

    document.getElementById('action-buttons').style.display = 'none';

    window.print();

    document.getElementById('action-buttons').style.display = 'block';
}
</script>

</div>

</div>
<style>
@media print {

    body * {
        visibility: hidden;
    }

    #gate-pass-content,
    #gate-pass-content * {
        visibility: visible;
    }

    #gate-pass-content {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }

    #action-buttons {
        display: none !important;
    }
}
</style>
</div>