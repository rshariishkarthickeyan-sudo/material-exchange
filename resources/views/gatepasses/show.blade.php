<x-app-layout>

<div class="container mx-auto p-6">

    <h2 class="text-2xl font-bold mb-4">
        Gate Pass Details
    </h2>

    <div class="mb-4">

        <p><strong>Gate Pass:</strong>
            {{ $gatepass->gate_pass_no }}
        </p>

        <p><strong>Category:</strong>
            {{ $gatepass->category }}
        </p>

        <p><strong>Status:</strong>
            {{ $gatepass->status }}
        </p>

        <p><strong>Taken By:</strong>
            {{ $gatepass->taken_by }}
        </p>

    </div>

    <table class="table-auto w-full border">

        <thead>

        <tr>

            <th class="border p-2">Code</th>
            <th class="border p-2">Name</th>
            <th class="border p-2">Qty</th>
            <th class="border p-2">Unit</th>

        </tr>

        </thead>

        <tbody>

        @foreach($gatepass->materials as $item)

            <tr>

                <td class="border p-2">
                    {{ $item->material_code }}
                </td>

                <td class="border p-2">
                    {{ $item->material_name }}
                </td>

                <td class="border p-2">
                    {{ $item->quantity }}
                </td>

                <td class="border p-2">
                    {{ $item->unit }}
                </td>

            </tr>

        @endforeach

        </tbody>

    </table>

</div>

</x-app-layout>