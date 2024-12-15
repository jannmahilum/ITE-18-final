<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="second-page">
  <div class="container">
    <div class="card login-card">
      <!-- Back Button -->
      <button class="back-btn" onclick="window.history.back();">
        <i class="fas fa-arrow-left"></i>
      </button>
      <!-- Logo -->
      <div class="logo-container">
        <img src="{{ asset('images/logo.png') }}" alt="NSTP Logo" class="logo">
      </div>
      <!-- Welcome Text -->
      <h1 class="login-heading">WELCOME</h1>
      <p class="login-subheading">Please enter your account.</p>
      
      <!-- Login Form -->
      <form method="POST" action="{{ route('login') }}" class="login-form">
        @csrf
        <input type="text" id="username" name="username" placeholder="USERNAME" required>
        <input type="password" id="password" name="password" placeholder="PASSWORD" required>
        
        @error('login')
          <div class="error-message">{{ $message }}</div> <!-- Display error if login fails -->
        @enderror
        
        <button type="submit" class="btn login-btn">Log in</button>
      </form>

      <!-- Google Login Button -->
      <div class="google-login">
        <a href="{{ url('auth/google') }}" class="btn btn-google">
          Sign in with Google
        </a>
      </div>
      
      <!-- Footer -->
      <div class="footer">NSTP SERVICE RECORDS</div>
    </div>
  </div>

  <script>
    // Retrieve selected field from sessionStorage or Laravel session
    const fieldFromStorage = sessionStorage.getItem('selectedField') || '{{ session('field', 'Unknown Field') }}';
    document.getElementById('field-name').textContent = fieldFromStorage;
  </script>
</body>
</html>
