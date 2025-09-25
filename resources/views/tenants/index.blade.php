<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h6>All Tenants</h6>
    <div class="max-w-3xl mx-auto p-6">
        <h2 class="text-xl font-bold mb-4">Available Sites</h2>

        <div class="grid grid-cols-2 gap-4">
            @foreach($domains as $domain)
                <a href="http://{{ $domain->domain }}:8000/login">
                    <button class="bg-green-600 text-white px-4 py-2 rounded w-full">
                        <!-- Display name from data or fallback to tenant's name -->
                        {{ optional($domain->tenant->data)['name'] ?? optional($domain->tenant)->name ?? 'No Name Available' }}
                    </button>
                </a>
            @endforeach
        </div>
    </div>
</body>
</html>
