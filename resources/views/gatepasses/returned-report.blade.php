<x-app-layout>

<div class="max-w-7xl mx-auto p-6">

    <h2 class="text-2xl font-bold mb-4">
        Returned Materials Report
    </h2>

    @if($gatepasses->count())

    <table class="table-auto border w-full">

        <thead>

            <tr class="bg-gray-200">

                <th class="border p-2">GP No</th>
                <th class="border p-2">Category</th>
                <th class="border p-2">Destination</th>
                <th class="border p-2">Returned Date</th>
                <th class="border p-2">Status</th>
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
                    {{ $gatepass->destination }}
                </td>

                <td class="border p-2">
                    {{ $gatepass->returned_date }}
                </td>

                <td class="border p-2 text-green-600 font-bold">
                    {{ $gatepass->status }}
                </td>

                <td class="border p-2">

                    <a
                        href="{{ route('returned.view',$gatepass->id) }}"
                        class=" bg-blue-600 text-white px-3 py-1 rounded">

                        View

                    </a>
                </td>
            </tr>

            @endforeach

        </tbody>

    </table>

    @else

    <div class="bg-yellow-100 p-4 rounded">

        No Returned Records Found

    </div>

    @endif

</div>

</x-app-layout>