<!DOCTYPE html>
@if(auth()->check())
    <script>
        window.location.replace("{{ route('dashboard') }}");
    </script>
@endif
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Material Management System</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-xl rounded-xl p-10"
     style="width:1000px; min-height:450px;">
     
     <div class="w-full max-w-3xl mx-auto mt-4">

        <h1 class="text-3xl font-bold text-center text-blue-700 mb-2">
            Material Management System
        </h1>

        <p class="text-center text-gray-500 mb-8">
            Gate Pass & Material Tracking Portal
        </p>

<form method="POST" action="{{ route('login') }}" autocomplete="off">
    @csrf

    <div class="mb-4">
        <label class="block mb-1 font-semibold">
            Username
        </label>

        <input
            type="text"
            name="username"
            autocomplete="off"
            placeholder="Enter Username"
            class="w-full border rounded px-3 py-2"
            required>
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-semibold">
            Password
        </label>

        <input
            type="password"
            name="password"
            autocomplete="new-password"
            placeholder="Enter Password"
            class="w-full border rounded px-3 py-2"
            required>
    </div>

    <div class="mb-4">
    <label class="block mb-1 font-semibold">
        User Role
    </label>

    <select
        name="role"
        required
        class="w-full border rounded px-3 py-2">

        <option value="" selected disabled>
            Select Role
        </option>

        <option value="employee">Employee</option>
        <option value="authority">Approving Authority</option>
        <option value="security">Security</option>
        <option value="admin">Admin</option>

    </select>
</div>

    <button
        type="submit"
        class="block w-40 mx-auto bg-blue-600 text-white py-2 rounded">
        Login
    </button>
</form>

    <div class="text-center mt-4">
        <p class="text-gray-600">
            New User?
        </p>

        <a href="{{ route('register') }}"
           class="inline-block mt-2 bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded">
            Register
        </a>
    </div>

</div>
</body>
</html>