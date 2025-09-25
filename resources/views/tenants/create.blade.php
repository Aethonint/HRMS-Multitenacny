<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Creation Form</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    @php
    $appUrl = parse_url(config('app.url'), PHP_URL_HOST); // Extracts 'localhost' from 'http://localhost'
@endphp

    <div class="max-w-4xl mx-auto mt-10 bg-white shadow-lg rounded-lg p-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-2">🛠️ Site Creation Form</h2>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('tenants.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Site Name</label>
                    <input type="text" name="site_name" class="border border-gray-300 rounded-md p-2 w-full focus:ring-2 focus:ring-green-500" value="{{ old('site_name') }}">
                </div>
              <div class="relative">
    <label class="block text-sm font-medium text-gray-700 mb-1">Domain</label>
    <div class="flex items-center border border-gray-300 rounded-md p-2 w-full focus-within:ring-2 focus-within:ring-green-500">
        <input type="text" name="domain" class="flex-grow focus:outline-none" placeholder="example" value="{{ old('domain') }}">
        <span class="text-gray-500 ml-2">.{{ $appUrl }}</span>
    </div>
</div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Admin First Name</label>
                    <input type="text" name="first_name" class="border border-gray-300 rounded-md p-2 w-full focus:ring-2 focus:ring-green-500" value="{{ old('first_name') }}">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Admin Last Name</label>
                    <input type="text" name="last_name" class="border border-gray-300 rounded-md p-2 w-full focus:ring-2 focus:ring-green-500" value="{{ old('last_name') }}">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Admin Email</label>
                    <input type="email" name="email" class="border border-gray-300 rounded-md p-2 w-full focus:ring-2 focus:ring-green-500" value="{{ old('email') }}">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" class="border border-gray-300 rounded-md p-2 w-full focus:ring-2 focus:ring-green-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="border border-gray-300 rounded-md p-2 w-full focus:ring-2 focus:ring-green-500">
                </div>
            </div>

            <div class="mt-8 flex gap-4">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-md shadow">✅ Submit</button>
                <button type="reset" class="bg-gray-400 hover:bg-gray-500 text-white font-semibold px-6 py-2 rounded-md shadow">❌ Cancel</button>
            </div>
        </form>
    </div>
</body>
</html>