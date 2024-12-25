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
  <div class="profile-avatar-container">
  <!-- Profile Avatar Circle -->
  @auth
    <div class="profile-avatar">
      <img src="{{ Auth::user()->avatar }}" alt="">
    </div>
    <!-- Profile Details shown on hover -->
    <div class="profile-details">
      <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
      <p><strong>Email:</strong> {{ Auth::user()->email }}</p>

      <!-- Logout Button -->
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
      </form>

<!-- Delete Account Button with confirmation -->
<form method="POST" action="{{ route('deleteAccount') }}" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">
  @csrf
  @method('DELETE')
  <button type="submit" style="background-color: #e74c3c;">Delete Account</button>
</form>

    </div>
  @endauth
</div>
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
<script>
   // Function to show the user details modal
   function showUserDetails() {
    var modal = document.getElementById("userDetailsModal");
    modal.style.display = "block";  // Show the modal beside the avatar
  }

  // Function to close the modal
  function closeModal() {
    var modal = document.getElementById("userDetailsModal");
    modal.style.display = "none";  // Hide the modal when close button is clicked
  }

  // Close the modal if the user clicks outside of the modal
  window.onclick = function(event) {
    var modal = document.getElementById("userDetailsModal");
    if (event.target === modal) {
      modal.style.display = "none";  // Close the modal if user clicks outside of it
    }
  }

</script>


    </form>
    <div class="footer5">NSTP SERVICE RECORDS</div>
  </div>
</body>
</html>
