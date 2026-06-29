<x-app-layout>

    <div class="container mx-auto p-6">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">
                Gate Pass Management
            </h1>

            <a href="{{ route('gatepasses.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded">
                Create Gate Pass
            </a>
        </div>

        <div class="bg-white shadow rounded p-4">

            <table class="table-auto w-full border">

                <thead>
                    <tr>
                        <th class="border p-2">ID</th>
                        <th class="border p-2">Gate Pass No</th>
                        <th class="border p-2">Category</th>
                        <th class="border p-2">Status</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td colspan="4" class="text-center p-4">
                            No Gate Passes Found
                        </td>
                    </tr>
                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>