<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('auth/style.css') }}">
</head>
<body>
  <div class="wrapper">
    <form method="POST" action="{{ route('register') }}">
      @csrf
      <h2>Register</h2>
      <div class="input-field">
        <input type="text" id="username" name="username" required>
        <label for="username" style="color: rgb(251, 142, 198);">Username</label>
      </div>
      <div class="input-field">
        <input type="text" id="name" name="name" required>
        <label for="name" style="color: rgb(251, 142, 198);">Name</label>
      </div>
      <div class="input-field">
        <input type="email" id="email" name="email" required>
        <label for="email" style="color: rgb(251, 142, 198);">Email</label>
      </div>
      <div class="input-field">
        <input type="text" id="alamat" name="alamat" required>
        <label for="alamat" style="color: rgb(251, 142, 198);">Alamat</label>
      </div>
      <div class="input-field">
        <input type="password" id="password" name="password" required>
        <label for="password" style="color: rgb(251, 142, 198);">Password</label>
      </div>
      <div class="input-field">
        <input type="password" id="password_confirmation" name="password_confirmation" required>
        <label for="password_confirmation" style="color: rgb(251, 142, 198);">Konfirmasi Password</label>
      </div>
      <button type="submit" style="color: rgb(251, 142, 198);">Register</button>
      <div class="register">
        <p>Sudah punya akun? <a href="{{ route('login') }}" style="color: rgb(251, 142, 198);">Login</a></p>
      </div>
    </form>
  </div>
</body>
</html>