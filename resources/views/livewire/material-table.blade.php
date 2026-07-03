<div class="bg-white p-6 rounded shadow border mt-8">

    <div class="flex justify-between mb-4">

        <h2 class="text-2xl font-bold text-black">
            Material Master
        </h2>

        <div class="flex gap-2">

            <button
                wire:click="addRow"
                class="bg-blue-600 text-black px-4 py-2 rounded">

                Add Material

            </button>

            <button
                wire:click="save"
                class="bg-green-600 text-black px-4 py-2 rounded">

                Save Materials

            </button>

        </div>

    </div>

    <div class="overflow-x-auto">

        <table class="w-full border">

            <thead>

            <tr class="bg-gray-100">

                <th class="border p-2 text-black">Code</th>
                <th class="border p-2 text-black">Name</th>
                <th class="border p-2 text-black">Category</th>
                <th class="border p-2 text-black">Unit</th>
                <th class="border p-2 text-black">Stock</th>
                <th class="border p-2 text-black">Location</th>
                <th class="border p-2 text-black">Status</th>
                <th class="border p-2 text-black">Action</th>

            </tr>

            </thead>

            <tbody>

            @foreach($materials as $index => $row)

                <tr>

                    <td class="border p-2">
                        <input type="text"
                            wire:model.live="materials.{{ $index }}.material_code"
                            class="w-full border p-2 text-black">
                    </td>

                    <td class="border p-2">
                        <input type="text"
                            wire:model.live="materials.{{ $index }}.material_name"
                            class="w-full border p-2 text-black">
                    </td>

                    <td class="border p-2">

                        <select
                            wire:model.live="materials.{{ $index }}.material_category_id"
                            class="w-full border p-2 text-black">

                            <option value="">
                                Select
                            </option>

                            @foreach($categories as $category)

                                <option value="{{ $category->id }}">
                                    {{ $category->category_name }}
                                </option>

                            @endforeach

                        </select>

                    </td>

                    <td class="border p-2">
                        <input type="text"
                            wire:model.live="materials.{{ $index }}.unit"
                            class="w-full border p-2 text-black">
                    </td>

                    <td class="border p-2">
                        <input type="number"
                            wire:model.live="materials.{{ $index }}.stock_quantity"
                            class="w-full border p-2 text-black">
                    </td>

                    <td class="border p-2">
                        <input type="text"
                            wire:model.live="materials.{{ $index }}.location"
                            class="w-full border p-2 text-black">
                    </td>

                    <td class="border p-2">

                        <select
                            wire:model.live="materials.{{ $index }}.status"
                            class="w-full border p-2 text-black">

                            <option value="ACTIVE">
                                ACTIVE
                            </option>

                            <option value="INACTIVE">
                                INACTIVE
                            </option>

                        </select>

                    </td>

                    <td class="border p-2">

                        <button
                            wire:click="deleteRow({{ $index }})"
                            class="bg-red-600 text-black px-3 py-2 rounded">

                            Delete

                        </button>

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>