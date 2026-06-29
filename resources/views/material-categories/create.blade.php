<x-app-layout>

<div class="container mx-auto p-6">

    <h1 class="text-3xl font-bold text-black mb-4">
        Add Material Category
    </h1>

    <form method="POST"
          action="{{ route('material-categories.store') }}">

        @csrf

        <div class="mb-4">

            <label class="block text-black">
                Category Name
            </label>

            <input type="text"
                   name="category_name"
                   class="border border-black p-2 w-full">

        </div>

        <div class="mb-4">

            <label class="block text-black">
                Category Code
            </label>

            <input type="text"
                   name="category_code"
                   class="border border-black p-2 w-full">

        </div>

        <button type="submit"
                class="border border-black bg-gray-200 text-black px-4 py-2">

            Save Category

        </button>

    </form>

</div>

</x-app-layout>