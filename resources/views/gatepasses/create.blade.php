<x-app-layout>

    <div class="container mx-auto p-6">

        <h1 class="text-3xl font-bold mb-6">
            Create Gate Pass
        </h1>

        <form action="{{ route('gatepasses.store') }}" method="POST">

            @csrf

            <div class="bg-white shadow rounded p-6">

                <div class="mb-4">
                    <label class="block font-semibold">Category</label>

                    <select name="category" class="border rounded w-full p-2">
                        <option value="RETURNABLE">RETURNABLE</option>
                        <option value="NON_RETURNABLE">NON RETURNABLE</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold">Taken By</label>

                    <input type="text"
                           name="taken_by"
                           class="border rounded w-full p-2">
                </div>

                <div class="mb-4">
                    <label class="block font-semibold">Destination</label>

                    <input type="text"
                           name="destination"
                           class="border rounded w-full p-2">
                </div>

                <div class="mb-4">
                    <label class="block font-semibold">Transport Mode</label>

                    <input type="text"
                           name="transport_mode"
                           class="border rounded w-full p-2">
                </div>

                <div class="mb-4">
                    <label class="block font-semibold">Due Date</label>

                    <input type="date"
                           name="due_date"
                           class="border rounded w-full p-2">
                </div>

                <div class="mb-4">
                    <label class="block font-semibold">Remarks</label>

                    <textarea name="remarks"
                              class="border rounded w-full p-2"
                              rows="3"></textarea>
                </div>

            </div>

            <div class="mt-6">
                <button type="submit"
                        style="border:1px solid black; background:#e5e7eb; color:black; padding:8px 16px;">
                    Save Gate Pass
                </button>
            </div>

        </form>

    </div>

</x-app-layout>