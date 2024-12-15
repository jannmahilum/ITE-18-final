<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Fill Up</title>
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  <link rel="stylesheet" href="{{ asset('css/studentfillup.css') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="second-page">
  <div class="container">
  <div class="logo-container">
        <img src="{{ asset('images/logo.png') }}" alt="NSTP Logo" class="logo">
      </div>



    <h1>Fill Your Details</h1>
    <form class="form" method="POST" action="{{ route('student.submit') }}">
      @csrf
      <label for="id-number">ID Number</label>
      <input type="text" id="id-number" name="id-number" placeholder="ID Number" required>
      
      <label for="instructor">Instructor</label>
      <select id="instructor" name="instructor" required>
        <option value="" disabled selected>SELECT</option>
        <!-- You can dynamically populate instructor options here -->
      </select>

      <label for="section">Section</label>
      <select id="section" name="section" required>
        <option value="" disabled selected>SELECT</option>
        <!-- Add sections dynamically based on the chosen field -->
      </select>

      <button type="submit" class="submit-button">Submit</button>
    </form>
    <div class="footer5">NSTP SERVICE RECORDS</div>
  </div>
</body>
</html>
