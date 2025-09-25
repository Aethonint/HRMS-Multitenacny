<!DOCTYPE html>
<html>
<head>
    <title>Tenant Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-10">
    <div class="max-w-2xl mx-auto bg-white shadow p-6 rounded">
        <h1 class="text-2xl font-bold mb-4">Welcome, {{ Auth::user()->first_name }}</h1>
        <p class="text-gray-700">You are logged into tenant: <strong>{{ tenant('name') }}</strong></p>

        <form method="POST" action="{{ route('logout') }}" class="mt-6">
            @csrf
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                Logout
            </button>
        </form>
    </div>
</body>
</html>
