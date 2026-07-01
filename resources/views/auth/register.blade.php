<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Register | Mini X</title>

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
            max-width: 450px;
            padding: 35px;
            border: 1px solid #2f3336;
            border-radius: 18px;
        }

        h1 {
            text-align: center;
        }

        label {
            display: block;
            margin: 16px 0 8px;
        }

        input {
            width: 100%;
            padding: 13px;
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
            padding: 10px;
            color: #ff6b6b;
            border: 1px solid #ff6b6b;
            border-radius: 8px;
        }

        .login-link {
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
        <h1>Create Mini X account</h1>

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register.submit') }}">
            @csrf

            <label for="name">Name</label>

            <input
                type="text"
                id="name"
                name="name"
                maxlength="100"
                value="{{ old('name') }}"
                required
            >

            <label for="email">Email</label>

            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                required
            >

            <label for="phone">Phone</label>

            <input
                type="text"
                id="phone"
                name="phone"
                maxlength="20"
                value="{{ old('phone') }}"
                required
            >

            <label for="pwd">Password</label>

            <input
                type="password"
                id="pwd"
                name="pwd"
                required
            >

            <button type="submit">
                Create account
            </button>
        </form>

        <div class="login-link">
            Already have an account?

            <a href="{{ route('login') }}">
                Login
            </a>
        </div>
    </main>
</body>
</html>