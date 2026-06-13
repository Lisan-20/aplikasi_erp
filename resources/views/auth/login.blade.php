<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Aplikasi RS</title>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background: #f0f0f0; }
        .login-box { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 300px; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Login</h2>
        @if($errors->any())
            <p style="color:red;">{{ $errors->first() }}</p>
        @endif
        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            User ID: <input type="text" name="txt_name" required>
            Password: <input type="password" name="txt_pass" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
