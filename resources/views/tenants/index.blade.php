<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'HATS') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/avatars/update-hats.svg') }}" />

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom right, #001f3f, #007B8F);
            color: #fff;
            min-height: 100vh;
        }

        .header {
            text-align: center;
            padding: 40px 20px;
        }

        .header img {
            width: 180px;
        }

        .login-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 40px;
            margin-top: 20px;
        }

        .login-section {
            background: linear-gradient(90deg, #001030, #006670);
            width: 50%;
            border-radius: 12px;
            padding: 40px 30px;
            text-align: center;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .login-section h2 {
            font-size: 1.8em;
            margin-bottom: 10px;
        }

        .login-section p {
            font-size: 1.1em;
            margin-bottom: 25px;
            color: #d1d1d1;
        }

        .login-btn, .site-btn {
            padding: 12px 24px;
            background-color: #00b983;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1.1em;
            transition: 0.3s;
        }

        .login-btn:hover, .site-btn:hover {
            background-color: #00805d;
        }

        .site-buttons {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ asset('img/avatars/hatswhite.png') }}" alt="Company Logo">
    </div>

    <div class="login-container">
        <!-- Super Admin Login -->
        <div class="login-section">
            <h2>Super Admin Login</h2>
            <p>Access the central dashboard to manage all sites.</p>
            <a href="{{ route('admin.login') }}">
                <button class="login-btn">Login</button>
            </a>
        </div>

        <!-- Tenant Site Logins -->
        <div class="login-section">
            <h2>Site Logins</h2>
            <p>Select a site to log in as Tenant Admin.</p>
            <div class="site-buttons">
                @foreach($domains as $domain)
                    <a href="http://{{ $domain->domain }}/login">
                        <button class="site-btn">{{ $domain->tenant->name ?? 'Unnamed Site' }}</button>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>
