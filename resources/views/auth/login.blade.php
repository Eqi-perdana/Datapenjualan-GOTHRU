<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="./user.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #4e73df, #1cc88a);
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .login-container {
            background: #fff;
            padding: 30px 25px;
            border-radius: 15px;
            box-shadow: 0px 6px 20px rgba(0,0,0,0.2);
            width: 350px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            text-align: left;
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #555;
        }

        input {
            width: 95%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            outline: none;
            transition: 0.3s;
        }

        input:focus {
            border-color: #4e73df;
            box-shadow: 0px 0px 5px rgba(78,115,223,0.5);
        }

        button {
            width: 100%;
            padding: 12px;
            background: #4e73df;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #2e59d9;
        }

        .error-message {
            color: red;
            margin-bottom: 15px;
            font-size: 14px;
        }

        /* Tombol Home pojok kanan atas (dibesarkan) */
        .home-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 15px 30px;  /* lebih besar */
            background: #1cc88a;
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 18px;  /* teks lebih besar */
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            transition: 0.3s;
        }

        .home-btn:hover {
            background: #17a673;
        }
    </style>
</head>
<body>

    <!-- Tombol Home pojok kanan atas -->
    <a href="/" class="home-btn">Home</a>

    <div class="login-container">
        <h2>Login</h2>

        @if ($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="/login" autocomplete="off">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       autocomplete="off"
                       autofocus>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password"
                       name="password"
                       required
                       autocomplete="new-password">
            </div>
            <button type="submit">Login</button>
        </form>
    </div>

</body>
</html>
