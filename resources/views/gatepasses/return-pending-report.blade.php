<x-app-layout>

<div class="max-w-7xl mx-auto p-6">

    <h2 class="text-2xl font-bold mb-4">
        Return Pending Report
    </h2>

    <table class="table-auto border w-full">

        <thead>

            <tr class="bg-gray-200">

                <th class="border p-2">
                    GP No
                </th>

                <th class="border p-2">
                    Category
                </th>

                <th class="border p-2">
                    Destination
                </th>

                <th class="border p-2">
                    Due Date
                </th>

                <th class="border p-2">
                    Status
                </th>

                <th class="border p-2">
                    Action
                </th>

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
                    {{ $gatepass->due_date }}
                </td>

                <td class="border p-2">
                    {{ $gatepass->status }}
                </td>

                <td class="border p-2">

                    <a
                        href="{{ route('return.view', $gatepass->id) }}"
                        class="bg-blue-600 text-white px-3 py-1 rounded">

                        View

                    </a>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="6" class="border p-4 text-center">

                    No Return Pending Records Found

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

</x-app-layout>