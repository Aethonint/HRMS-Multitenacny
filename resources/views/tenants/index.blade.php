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
            background: linear-gradient(to bottom right, #3f4254, #f39517);
            color: #f39517 !important;
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

        .login-sections-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .login-section {
            background: #fff;
            width: 45%;
            border-radius: 12px;
            padding: 40px 30px;
            text-align: center;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            color: #3f4254;
            transition: 0.3s;
        }

        .login-section:hover {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .login-section h2 {
            font-size: 1.8em;
            margin-bottom: 10px;
            color: #3f4254;
        }

        .login-section p {
            font-size: 1.1em;
            margin-bottom: 25px;
            color: #d1d1d1;
        }

        .login-btn, .site-btn {
            padding: 12px 24px;
            background-color: #f39517;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1.1em;
            transition: 0.3s;
            text-decoration: none;
        }

        .login-btn:hover, .site-btn:hover {
            background-color: #e48206;
        }

        .site-buttons {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .login-section {
                width: 100%;
            }

            .login-sections-container {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ asset('img/avatars/hatswhite.png') }}" alt="Company Logo">
    </div>

    <div class="login-container">
        <div class="login-sections-container">
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
    </div>
</body>
</html>
