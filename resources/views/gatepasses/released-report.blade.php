<x-app-layout>

<div class="max-w-7xl mx-auto p-6">

    <h2 class="text-2xl font-bold mb-4">
        Released Material Report
    </h2>

    <table class="table-auto border w-full">

        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">Gate Pass No</th>
                <th class="border p-2">Category</th>
                <th class="border p-2">Destination</th>
                <th class="border p-2">Released Date</th>
                <th class="border p-2">Status</th>
            </tr>
        </thead>

        <tbody>

            @forelse($gatepasses as $gatepass)

            <tr>
                <td class="border p-2">
                    {{ $gatepass->gate_pass_no }}
                </td>

                <td class="border p-2">
                    {{ $gatepass->category }}
                </td>

                <td class="border p-2">
                    {{ $gatepass->destination }}
                </td>

                <td class="border p-2">
                    {{ $gatepass->security_date }}
                </td>

                <td class="border p-2">
                    {{ $gatepass->status }}
                </td>
            </tr>

            @empty

            <tr>
                <td colspan="5" class="border p-2 text-center">
                    No Released Materials Found
                </td>
            </tr>

            @endforelse

        </tbody>

    </table>

</div>

</x-app-layout>