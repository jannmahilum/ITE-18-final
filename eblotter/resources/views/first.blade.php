<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NSR</title>
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  <link rel="stylesheet" href="{{ asset('css/first.css') }}">
</head>
<body class="first-page">
  <div class="container">
    <div class="card">
      <!-- Logo -->
      <div class="logo-container">
        <img src="{{ asset('logo/image.png') }}" alt="NSTP Logo" class="logo">
      </div>
      <!-- Buttons -->
      <div class="buttons-container">
        <button class="btn" onclick="location.href='{{ url('/choose-field?role=student') }}'">STUDENT</button>
        <button class="btn" onclick="location.href='{{ url('/choose-field?role=employee') }}'">EMPLOYEE</button>
      </div>
      <!-- Footer -->
      <div class="footer">NSTP SERVICE RECORDS</div>
    </div>
  </div>
</body>
</html>
