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
        <td class="border p-2 font-bold">Transport Mode</td>
        <td class="border p-2">{{ $gatepass->transport_mode }}</td>
    </tr>

    <tr>
        <td class="border p-2 font-bold">Vehicle No</td>
        <td class="border p-2">{{ $gatepass->vehicle_no }}</td>
    </tr>

    <tr>
        <td class="border p-2 font-bold">Description</td>
        <td class="border p-2">{{ $gatepass->description }}</td>
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
<h3 class="font-bold text-lg mb-2">
    Prepared By
</h3>

<table class="table-auto border w-full mb-6">

    <tr>
        <th class="border p-2">Name</th>
        <th class="border p-2">IC No</th>
        <th class="border p-2">Designation</th>
        <th class="border p-2">Group</th>
    </tr>

    <tr>
        <td class="border p-2">{{ $gatepass->prepared_name }}</td>
        <td class="border p-2">{{ $gatepass->prepared_ic_no }}</td>
        <td class="border p-2">{{ $gatepass->prepared_designation }}</td>
        <td class="border p-2">{{ $gatepass->prepared_group }}</td>
    </tr>

</table>
<h3 class="font-bold text-lg mb-2">
    Taken Out By
</h3>

<table class="table-auto border w-full mb-6">

    <tr>
        <th class="border p-2">Name</th>
        <th class="border p-2">IC No</th>
        <th class="border p-2">Designation</th>
        <th class="border p-2">Group</th>
    </tr>

    <tr>
        <td class="border p-2">{{ $gatepass->taken_name }}</td>
        <td class="border p-2">{{ $gatepass->taken_ic_no }}</td>
        <td class="border p-2">{{ $gatepass->taken_designation }}</td>
        <td class="border p-2">{{ $gatepass->taken_group }}</td>
    </tr>

</table>
<h3 class="font-bold text-lg mb-2">
    Approving Authority
</h3>

<table class="table-auto border w-full mb-6">

    <tr>
        <th class="border p-2">Name</th>
        <th class="border p-2">IC No</th>
        <th class="border p-2">Designation</th>
        <th class="border p-2">Group</th>
    </tr>

    <tr>
        <td class="border p-2">{{ $gatepass->authority_name }}</td>
        <td class="border p-2">{{ $gatepass->authority_ic_no }}</td>
        <td class="border p-2">{{ $gatepass->authority_designation }}</td>
        <td class="border p-2">{{ $gatepass->authority_group }}</td>
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