<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tenant Information</title>
</head>
<body>

    <h1>Welcome, {{ Auth::user()->tenant->name }}</h1>

         <!-- Show Logout Button for Super Admin and Tenant Manager -->
        <form action="{{ route('tenant.logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
   

</body>
</html>
