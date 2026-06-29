<x-app-layout>

    <div class="container mx-auto p-6">

        <h1 class="text-3xl font-bold mb-4">
            Material Management System
        </h1>

        <div class="mt-4">
            <a href="{{ route('gatepasses.index') }}"
               class="bg-blue-500 text-black px-4 py-2 rounded">
                Gate Pass Management
            </a>
        </div>

        <div class="bg-white p-4 rounded shadow mt-4">

            <h2 class="text-xl font-semibold">
                Welcome {{ auth()->user()->name }}
            </h2>

            <p class="mt-2">
                Role : {{ auth()->user()->role }}
            </p>

        </div>

    </div>

</x-app-layout>