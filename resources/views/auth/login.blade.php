<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('http://127.0.0.1:8000/') }}">
    @csrf

    <input
        type="email"
        name="email"
        placeholder="Email"
        class="w-full border rounded px-3 py-2 mb-3">

    <input
        type="password"
        name="password"
        placeholder="Password"
        class="w-full border rounded px-3 py-2 mb-3">

    <button
        type="submit"
        class="bg-blue-600 text-white px-4 py-2 rounded">
        Login
    </button>
</form>
</x-guest-layout>
