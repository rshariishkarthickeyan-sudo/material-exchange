<x-app-layout>

<div class="max-w-7xl mx-auto p-6">

    <div class="bg-white shadow rounded p-6">

        <h2 class="text-2xl font-bold mb-4">
            Returned Material Details
        </h2>

        <table class="table-auto border w-full mb-6">

            <tr>
                <td class="border p-2 font-bold">Gate Pass No</td>
                <td class="border p-2">{{ $gatepass->id }}</td>
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

            <tr>
                <td class="border p-2 font-bold">Approved By</td>
                <td class="border p-2">
                    {{ optional($gatepass->approver)->name }}
                </td>
            </tr>

            <tr>
                <td class="border p-2 font-bold">Security Released By</td>
                <td class="border p-2">
                    {{ optional($gatepass->security)->name }}
                </td>
            </tr>

            <tr>
                <td class="border p-2 font-bold">Returned By</td>
                <td class="border p-2">
                    {{ $gatepass->returned_by }}
                </td>
            </tr>

            <tr>
                <td class="border p-2 font-bold">Returned Date</td>
                <td class="border p-2">{{ $gatepass->returned_date }}</td>
            </tr>

        </table>

        <h3 class="text-xl font-bold mb-3">
            Material Details
        </h3>

        <table class="table-auto border w-full mb-6">

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

        <div class="space-y-4">

            <h3 class="font-bold mt-6 mb-2">
                Approver Remarks
            </h3>

        <textarea
            class="w-full border rounded p-3 bg-gray-100"
            rows="4"
            readonly>{{ $gatepass->approver_remarks }}</textarea>

<h3 class="font-bold mt-6 mb-2">
    Security Remarks
</h3>

<textarea
    class="w-full border rounded p-3 bg-gray-100 mt-3"
    rows="4"
    readonly>{{ $gatepass->security_remarks }}</textarea>

<h3 class="font-bold mt-6 mb-2">
    Return Remarks
</h3>

<textarea
    class="w-full border rounded p-3 bg-gray-100 mt-3"
    rows="4"
    readonly>{{ $gatepass->return_remarks }}</textarea>

        </div>

    </div>

</div>

</x-app-layout>