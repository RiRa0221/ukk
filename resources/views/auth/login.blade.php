<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('auth/style.css') }}">
</head>
<body>
  <div class="wrapper">
    <form method="POST" action="{{ route('login') }}">
      @csrf
      <h2>Login</h2>
      <div class="input-field">
        <input type="email" id="email" name="email" required>
        <label for="email" style="color: rgb(251, 142, 198)">Enter your email</label>
      </div>
      <div class="input-field">
        <input type="password" id="password" name="password" required>
        <label for="password" style="color: rgb(251, 142, 198)">Enter your password</label>
      </div>
      <div class="forget">
        <label for="remember">
          <input type="checkbox" id="remember" name="remember">
          <p>Remember me</p>
        </label>
        <a href="#">Forgot password?</a>
      </div>
      <button type="submit" style="color: rgb(251, 142, 198)">Login</button>
      <div class="register">
        <p>Don't have an account? <a href="{{ route('register') }}" style="color: rgb(251, 142, 198)">Register</a></p>
      </div>
    </form>
  </div>
</body>
</html>
