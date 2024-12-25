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
      
      <button class="back-btn" onclick="window.history.back();">
        <i class="fas fa-arrow-left"></i>
      </button>
   
      <div class="logo-container">
        <img src="{{ asset('images/logo.png') }}" alt="NSTP Logo" class="logo">
      </div>
    
      <h1 class="login-heading">WELCOME</h1>
      <p class="login-subheading">Please enter your account.</p>
      

    @if(session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif




      
      <form method="POST" action="{{ route('login') }}" class="login-form">
        @csrf
        <input type="text" id="username" name="username" placeholder="USERNAME" required>
        <input type="password" id="password" name="password" placeholder="PASSWORD" required>
        
      
        <button type="submit" class="btn login-btn">Log in</button>
      </form>
    <hr>


    <div class="google-login">
    <a href="{{ route('google.login') }}">
        <button type="button" class="google-btn">
          <i class="fab fa-google"></i> Sign in with Google
        </button>
    </a>
</div>


      <div class="footer">NSTP SERVICE RECORDS</div>
    
</div>
<script>

    const fieldFromStorage = sessionStorage.getItem('selectedField') || '{{ session('field', 'Unknown Field') }}';
    document.getElementById('field-name').textContent = fieldFromStorage;
  </script>
</body>
</html>
