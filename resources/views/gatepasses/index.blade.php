<x-app-layout>

    <div class="container mx-auto p-6">

        <div class="flex justify-between items-center mb-6">

            <h1 class="text-3xl font-bold text-black">
                Gate Pass Management
            </h1>

            <a href="{{ route('gatepasses.create') }}"
               class="border border-black bg-gray-200 text-black px-4 py-2 rounded">
                Create Gate Pass
            </a>

        </div>

        @if(session('success'))
            <div class="border border-green-500 bg-green-100 text-black p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow rounded p-4">

            <table class="table-auto w-full border border-black">

                <thead>

                    <tr class="bg-gray-200">

                        <th class="border border-black p-2 text-black">ID</th>

                        <th class="border border-black p-2 text-black">
                            Gate Pass No
                        </th>

                        <th class="border border-black p-2 text-black">
                            Category
                        </th>

                        <th class="border border-black p-2 text-black">
                            Taken By
                        </th>

                        <th class="border border-black p-2 text-black">
                            Destination
                        </th>

                        <th class="border border-black p-2 text-black">
                            Status
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($gatepasses as $gatepass)

                        <tr>

                            <td class="border border-black p-2 text-black">
                                {{ $gatepass->id }}
                            </td>

                            <td class="border border-black p-2 text-black">
                                {{ $gatepass->gate_pass_no }}
                            </td>

                            <td class="border border-black p-2 text-black">
                                {{ $gatepass->category }}
                            </td>

                            <td class="border border-black p-2 text-black">
                                {{ $gatepass->taken_by }}
                            </td>

                            <td class="border border-black p-2 text-black">
                                {{ $gatepass->destination }}
                            </td>

                            <td class="border border-black p-2 text-black">
                                {{ $gatepass->status }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6"
                                class="border border-black p-4 text-center text-black">

                                No Gate Passes Found

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>