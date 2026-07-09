<x-app-layout>

<div class="max-w-7xl mx-auto p-6">

    <div class="bg-white shadow rounded p-6">

        <h2 class="text-2xl font-bold mb-4">
            Gate Pass Details
        </h2>

            </div>

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
                <td class="border p-2 font-bold">Taken By</td>
                <td class="border p-2">{{ $gatepass->taken_by }}</td>
            </tr>

            <tr>
                <td class="border p-2 font-bold">Destination</td>
                <td class="border p-2">{{ $gatepass->destination }}</td>
            </tr>

            <tr>
                <td class="border p-2 font-bold">Transport</td>
                <td class="border p-2">{{ $gatepass->transport_mode }}</td>
            </tr>

            <tr>
                <td class="border p-2 font-bold">Due Date</td>
                <td class="border p-2">{{ $gatepass->due_date }}</td>
            </tr>

            <tr>
                <td class="border p-2 font-bold">Status</td>
                <td class="border p-2">{{ $gatepass->status }}</td>
            </tr>

        </table>

        {{-- MATERIAL DETAILS --}}
<h3 class="font-bold text-xl mb-3">
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

            <td class="border p-2">
                {{ $material->material_code }}
            </td>

            <td class="border p-2">
                {{ $material->material_name }}
            </td>

            <td class="border p-2">
                {{ $material->description }}
            </td>

            <td class="border p-2">
                {{ $material->quantity }}
            </td>

            <td class="border p-2">
                {{ $material->unit }}
            </td>

            <td class="border p-2">
                {{ $material->price }}
            </td>

            <td class="border p-2">
                {{ $material->remarks }}
            </td>

        </tr>

        @endforeach

    </tbody>

</table>


<hr class="my-6">

@if($gatepass->status == 'PENDING_APPROVAL')

<hr class="my-4">

<h3 class="font-bold mb-3">
    Approver Remarks
</h3>

<form method="POST" action="{{ route('gatepass.approval', $gatepass->id) }}">
    @csrf

    <textarea
        name="approver_remarks"
        class="w-full border rounded p-2"
        rows="4">
    </textarea>

    <div class="mt-3">

        <button
            type="submit"
            name="action"
            value="approve"
            class="bg-green-600 text-white px-4 py-2 rounded">
            Approve
        </button>

        <button
            type="submit"
            name="action"
            value="reject"
            class="bg-red-600 text-white px-4 py-2 rounded">
            Reject
        </button>

    </div>

</form>

@endif


    </table>

    </div>

</div>
<style>
@media print {

    #print-button {
        display: none !important;
    }

}
</style>
</x-app-layout>