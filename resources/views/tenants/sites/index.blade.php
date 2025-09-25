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

    <!-- Form to Add an Employee -->
    <h2>Add Employee</h2>
    <form action="{{ route('tenant.add_employee') }}" method="POST">
        @csrf
        <div>
            <label for="name">first_name:</label>
            <input type="text" id="name" name="first_name" required>
        </div>
         <div>
            <label for="name">last_name:</label>
            <input type="text" id="name" name="last_name" required>
        </div>

        <div>
            <label for="email">Employee Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>

     
       

        <button type="submit">Add Employee</button>
    </form>

</body>
</html>
