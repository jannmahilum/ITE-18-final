<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Field Sections</title>
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  <link rel="stylesheet" href="{{ asset('css/employeesections.css') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="second-page">
  <div class="container">
    


      <!-- Heading Section -->
      <div class="section-heading">
        <p>Field</p>
        <h2 class="highlight">Loading...</h2> <!-- Field name will be updated here dynamically -->
      </div>
      
      <!-- Create Section Form -->
      <div class="create-section-form">
      <div class="card">
        <h3>Create a New Section</h3>
        <form id="createSectionForm">
          @csrf
          <div class="form-group">
            <label for="name">Section Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="form-group">
            <label for="description">Description (optional)</label>
            <textarea class="form-control" id="description" name="description"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Create Section</button>
        </form>
      </div>

      <!-- Container to display the sections dynamically -->
      <div id="sectionsContainer">
        @foreach($sections as $section)
          <div class="section-item" onclick="location.href='{{ route('section.details', ['section' => $section->id]) }}'">
            <p>{{ $section->name }}</p>
            <span>{{ count($section->students) }} Students</span>
          </div>
        @endforeach
      </div>

      <!-- Error or Success message -->
      <div id="message"></div>

      <!-- Footer -->
      <div class="footer">NSTP SERVICE RECORDS</div>
    </div>
  </div>

  <script>
    // Dynamically update the field name based on query parameters or localStorage
    function getQueryParam(name) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }

    // Retrieve the field from query parameters or localStorage
    const fieldFromQuery = getQueryParam('field');
    const fieldFromStorage = localStorage.getItem('selectedField');
    const field = fieldFromQuery || fieldFromStorage || 'Unknown';

    // Update the heading with the field name (check if the element exists)
    const fieldElement = document.querySelector('.section-heading .highlight');
    if (fieldElement) {
        fieldElement.textContent = field;
    }

    // AJAX form submission for creating a new section
    const form = document.getElementById('createSectionForm');
    form.addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission
        console.log('Form submitted'); // Log form submission

        const formData = new FormData(form);
        console.log('Form Data:', formData); // Log form data

        fetch("{{ route('employee.createSection') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}', // Add CSRF token to the headers
            },
            body: formData,
        })
        .then(response => {
            console.log('Response:', response); // Log response
            return response.json();
        })
        .then(data => {
            console.log('Response Data:', data); // Log the response data

            if (data.success) {
                // On success, add the new section to the list
                const newSection = document.createElement('div');
                newSection.classList.add('section-item');
                newSection.innerHTML = `
                    <p>${data.section.name}</p>
                    <span>${data.student_count} Students</span>
                `;

                // Ensure the target container exists before appending
                const sectionsContainer = document.getElementById('sectionsContainer');
                if (sectionsContainer) {
                    sectionsContainer.appendChild(newSection);
                }

                // Show success message
                const message = document.getElementById('message');
                message.textContent = 'Section created successfully!';
                message.style.color = 'green';

                // Clear the form inputs
                form.reset();
            } else {
                // Show error message
                const message = document.getElementById('message');
                message.textContent = 'Error: Could not create section.';
                message.style.color = 'red';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            const message = document.getElementById('message');
            message.textContent = 'There was a problem with the request.';
            message.style.color = 'red';
        });
    });
</script>

</body>
</html>
