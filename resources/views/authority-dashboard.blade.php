<x-app-layout>

<div class="p-6">

    <h1 class="text-2xl font-bold mb-6">
        Approving Authority Dashboard
    </h1>

    <div class="bg-yellow-500 text-white p-4 rounded shadow w-64 mb-6">

        <h3 class="font-bold">
            Pending Approvals
        </h3>

        <p class="text-3xl">
            {{ $gatepasses->count() }}
        </p>

    </div>

    <a href="{{ route('pending.approval.report') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">

        View Full Report

    </a>

    <div class="bg-white shadow rounded mt-6">

        <table class="w-full border-collapse border">

            <thead>

                <tr class="bg-gray-100">

                    <th class="border p-2">Gate Pass No</th>
                    <th class="border p-2">Category</th>
                    <th class="border p-2">Destination</th>
                    <th class="border p-2">Created Date</th>

                </tr>

            </thead>

            <tbody>

                @forelse($gatepasses as $pass)

                <tr>

                    <td class="border p-2">
                        {{ $pass->id}}
                    </td>

                    <td class="border p-2">
                        {{ $pass->category }}
                    </td>

                    <td class="border p-2">
                        {{ $pass->destination }}
                    </td>

                    <td class="border p-2">
                        {{ $pass->created_at->format('d-m-Y') }}
                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="4" class="text-center p-4">

                        No Pending Approvals

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

</x-app-layout>