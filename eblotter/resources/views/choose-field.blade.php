<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Choose Your Field</title>
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  <link rel="stylesheet" href="{{ asset('css/choose.css') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="second-page">
  <div class="container">
    <div class="card">
      <!-- Back Arrow Button -->
      <button class="back-btn" onclick="window.history.back();">
        <i class="fas fa-arrow-left"></i>
      </button>
      <!-- Logo -->
      <div class="logo-container">
        <img src="{{ asset('images/logo.png') }}" alt="NSTP Logo" class="logo">
      </div>
      <!-- Heading -->
      <h2 class="heading">Choose Your Field</h2>

      <!-- Display the role -->
       <div class="role">
       <p>{{ strtoupper($role) }}</p>
      </div>
      <!-- Buttons -->
      <div class="buttons-container">
        <button class="btn" onclick="location.href='{{ url('/login') }}'">CWTS</button>
        <button class="btn" onclick="location.href='{{ url('/login') }}'">ROTC</button>
        <button class="btn" onclick="location.href='{{ url('/login') }}'">LTS</button>
      </div>

      <!-- Footer -->
      <div class="footer">NSTP SERVICE RECORDS</div>
    </div>
  </div>
</body>
</html>
