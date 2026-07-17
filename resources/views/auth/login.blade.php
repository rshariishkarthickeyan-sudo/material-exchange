<x-guest-layout>

    <form method="POST" action="{{ route('login') }}" autocomplete="off">
    @csrf

    <div class="mb-4">
        <label class="block font-semibold mb-2">
            Username
        </label>

        <input
            type="text"
            name="username"
            placeholder="Enter Username"
            class="w-full border rounded px-3 py-2"
            required>
    </div>

    <div class="mb-4">
        <label class="block font-semibold mb-2">
            Password
        </label>

        <input
            type="password"
            name="password"
            placeholder="Enter Password"
            class="w-full border rounded px-3 py-2"
            required>
    </div>

    <div class="mb-6">
    <label class="block font-semibold mb-2">
        User Role
    </label>

    <select
    name="role"
    id="role"
    required
    class="w-full border rounded px-3 py-2">

    <option value="" {{ old('role') ? '' : 'selected' }} disabled>
        Select Role
    </option>

    <option value="employee" {{ old('role') == 'employee' ? 'selected' : '' }}>
        Employee
    </option>

    <option value="authority" {{ old('role') == 'authority' ? 'selected' : '' }}>
        Approving Authority
    </option>

    <option value="security" {{ old('role') == 'security' ? 'selected' : '' }}>
        Security
    </option>

    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>
        Admin
    </option>

</select>
</div>

    <div class="text-center">

        <button
            type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-2 rounded">
            Login
        </button>

        <div class="mt-4 text-gray-600">
            New User?
        </div>

        <a href="{{ route('register') }}"
           class="inline-block mt-2 bg-green-600 hover:bg-green-700 text-white px-10 py-2 rounded">
            Register
        </a>

    </div>

</form>

</x-guest-layout>