<x-app-layout>

<div class="max-w-7xl mx-auto p-6">

    <div class="bg-white shadow rounded p-6">

        <h2 class="text-2xl font-bold mb-4">
            Gate Pass Details
        </h2>

        <table class="table-auto border w-full mb-6">

            <tr>
                <td class="border p-2 font-bold">Gate Pass No</td>
                <td class="border p-2">{{ $gatepass->gate_pass_no }}</td>
            </tr>

            <tr>
                <td class="border p-2 font-bold">Category</td>
                <td class="border p-2">{{ $gatepass->category }}</td>
            </tr>

            <tr>
                <td class="border p-2 font-bold">Destination</td>
                <td class="border p-2">{{ $gatepass->destination }}</td>
            </tr>

            <tr>
                <td class="border p-2 font-bold">Status</td>
                <td class="border p-2">{{ $gatepass->status }}</td>
            </tr>

        </table>

        <h3 class="text-xl font-bold mb-3">
            Material Details
        </h3>

        <table class="table-auto border w-full">

            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Code</th>
                    <th class="border p-2">Name</th>
                    <th class="border p-2">Description</th>
                    <th class="border p-2">Qty</th>
                    <th class="border p-2">Unit</th>
                    <th class="border p-2">Price</th>
                    <th class="border p-2">Remarks</th>
                </tr>
            </thead>

            <tbody>

                @foreach($gatepass->materials as $material)

                <tr>
                    <td class="border p-2">{{ $material->material_code }}</td>
                    <td class="border p-2">{{ $material->material_name }}</td>
                    <td class="border p-2">{{ $material->description }}</td>
                    <td class="border p-2">{{ $material->quantity }}</td>
                    <td class="border p-2">{{ $material->unit }}</td>
                    <td class="border p-2">{{ $material->price }}</td>
                    <td class="border p-2">{{ $material->remarks }}</td>
                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

</x-app-layout>