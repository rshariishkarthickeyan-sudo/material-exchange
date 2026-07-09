<x-app-layout>

<div class="max-w-7xl mx-auto p-6">

    <div class="bg-white shadow rounded p-4">

        <h2 class="text-2xl font-bold mb-4">
            Department Materials Report
        </h2>

        <table class="table-auto w-full border">

            <thead>

                <tr class="bg-gray-200">

                    <th class="border p-2">GP No</th>
                    <th class="border p-2">Category</th>
                    <th class="border p-2">Taken By</th>
                    <th class="border p-2">Destination</th>
                    <th class="border p-2">Due Date</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Created Date</th>
                    <th class="border p-2">Action</th>

                </tr>

            </thead>

            <tbody>

                @foreach($gatepasses as $gatepass)

                <tr>

                    <td class="border p-2">
                        {{ $gatepass->gate_pass_no }}
                    </td>

                    <td class="border p-2">
                        {{ $gatepass->category }}
                    </td>

                    <td class="border p-2">
                        {{ $gatepass->taken_by }}
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
                        {{ $gatepass->created_at->format('d-m-Y') }}
                    </td>

<td class="border p-2">

    <a href="{{ route('gatepass.view', $gatepass->id) }}"
       class="bg-blue-500 text-white px-3 py-1 rounded">
       View
    </a>

    <a href="{{ route('gatepass.edit', $gatepass->id) }}"
       class="bg-yellow-500 text-white px-3 py-1 rounded ml-2">
       Edit
    </a>

</td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

</x-app-layout>