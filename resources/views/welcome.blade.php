<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Material Management System</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-xl rounded-lg p-10 w-full max-w-md">

        <h1 class="text-3xl font-bold text-center text-blue-700 mb-2">
            Material Management System
        </h1>

        <p class="text-center text-gray-500 mb-8">
            Gate Pass & Material Tracking Portal
        </p>

        <div class="mb-6">

            <label class="block mb-2 font-semibold">
                Select User Role
            </label>

            <select class="w-full border rounded px-3 py-2">

                <option>Employee</option>

                <option>Approving Authority</option>

                <option>Security</option>

                <option>Admin</option>

            </select>

        </div>

        <div class="space-y-4">

            <a href="{{ route('login') }}"
               class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white py-3 rounded">

                Login

            </a>

            <a href="{{ route('register') }}"
               class="block w-full text-center bg-green-600 hover:bg-green-700 text-white py-3 rounded">

                Register

            </a>

        </div>

    </div>

</div>

</body>
</html>