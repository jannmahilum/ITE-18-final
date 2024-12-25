<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Field Sections</title>
  
  <link rel="stylesheet" href="{{ asset('css/employeesections.css') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


</head>
<body>
<div class="header">



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






  Field<br>
  <span class="highlight" id="field-name">{{ session('field', 'Unknown Field') }}</span>
</div>



  <!-- Input Form -->
  <div class="content-container">
    <div class="form-container">
      <form method="POST" action="{{ route('employee.createSection') }}">
        @csrf
        <input type="text" id="section-name" name="name" placeholder="Section Name" required>
        <input type="text" id="description" name="description" placeholder="Description (optional)">
        <button type="submit" class="create-btn">Create Section</button>
      </form>
    </div>
  </div>

  <!-- Created Sections Below the Card -->
  <div class="sections-container">
    @foreach($sections as $section)
      <div class="section-item">
        <p>{{ $section->name }}</p>
        <span>{{ $section->description ?: 'No description' }}</span>
        <a href="{{ route('employee.showGradesTable', ['section' => $section->id]) }}" class="btn">View Records</a>
      </div>
    @endforeach
  </div>

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









    // Dynamically update the field name based on query parameters or localStorage
    function getQueryParam(name) {
      const urlParams = new URLSearchParams(window.location.search);
      return urlParams.get(name);
    }

    const fieldFromQuery = getQueryParam('field');
    const fieldFromStorage = localStorage.getItem('selectedField');
    const field = fieldFromQuery || fieldFromStorage || 'Unknown';

    // Update the heading with the field name
    document.getElementById('field-name').textContent = field;
  </script>

</body>
</html>
