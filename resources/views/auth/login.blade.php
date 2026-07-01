<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login | Mini X</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: #ffffff;
            background: #000000;
            font-family: Arial, sans-serif;
        }

        .card {
            width: 100%;
            max-width: 420px;
            padding: 35px;
            border: 1px solid #2f3336;
            border-radius: 18px;
        }

        .logo {
            margin-bottom: 15px;
            font-size: 42px;
            font-weight: bold;
            text-align: center;
        }

        h1 {
            text-align: center;
        }

        label {
            display: block;
            margin: 18px 0 8px;
        }

        input {
            width: 100%;
            padding: 14px;
            color: #ffffff;
            background: #000000;
            border: 1px solid #536471;
            border-radius: 8px;
            font-size: 16px;
        }

        input:focus {
            border-color: #1d9bf0;
            outline: none;
        }

        button {
            width: 100%;
            margin-top: 22px;
            padding: 14px;
            color: #000000;
            background: #ffffff;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .error {
            margin: 10px 0;
            padding: 10px;
            color: #ff6b6b;
            border: 1px solid #ff6b6b;
            border-radius: 8px;
        }

        .success {
            margin: 10px 0;
            padding: 10px;
            color: #00ba7c;
            border: 1px solid #00ba7c;
            border-radius: 8px;
        }

        .register-link {
            margin-top: 22px;
            color: #71767b;
            text-align: center;
        }

        a {
            color: #1d9bf0;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <main class="card">
        <div class="logo">X</div>

        <h1>Sign in to Mini X</h1>

        @if (session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf

            <label for="email">Email</label>

            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
            >

            <label for="pwd">Password</label>

            <input
                type="password"
                id="pwd"
                name="pwd"
                required
            >

            <button type="submit">
                Login
            </button>
        </form>

        <div class="register-link">
            Don't have an account?

            <a href="{{ route('register') }}">
                Register
            </a>
        </div>
    </main>
</body>
</html>