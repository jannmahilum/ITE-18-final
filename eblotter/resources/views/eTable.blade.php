<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Grades Table</title>
  
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/eTable.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

</head>
<body class="grades-page">
        
        <!-- Overlay -->
        <div class="overlay"></div>
        <button class="back-btn" onclick="window.history.back();">
            <i class="fas fa-arrow-left"></i>
          </button>
          
        <!-- Main Content -->
        <div class="content">
  <h2>Student Grading Table</h2>


  
  <div class="search-container">
    <button id="reset-btn">All</button>
    <input type="text" id="search-bar" placeholder="Search Student ID">
    
</div>
<div class="scrollable-container">
  <table>



      <thead>
          <tr>
              <th  class="empty-cell1" colspan="10" class="header">First Semester</th>
              <th  class="empty-cell1" colspan="15" class="header">Course & Year: </th>
              <th  class="empty-cell1" colspan="17" class="header">Instructor:</th>
              <th  class="empty-cell1" colspan="7" class="header">School Year:</th>
          </tr>
          <tr>
              <th  class="empty-cell" rowspan="4" class="header">Student ID</th>
              <th  class="empty-cell" rowspan="4" class="header">Names</th>
              <th  class="empty-cell" colspan="14" class="header">ATTENDANCE (10%)</th>
              <th  class="empty-cell" colspan="13" class="header">WRITTEN WORK (20%)</th>
              <th  class="empty-cell" colspan="13" class="header">PERFORMANCE TASKS (40%)</th>
              <th  class="empty-cell" colspan="5" class="header">EXAMINATION (30%)</th>
              <th  class="empty-cell" rowspan="3" class="header">SEMESTER GRADE</th>
              <th  class="empty-cell" rowspan="3" class="header">STATUS (Pass/Fail)</th>
          </tr>
          <tr>
            <th  class="empty-cell1">#</th>
            <th  class="empty-cell1">1</th>
            <th  class="empty-cell1">2</th>
            <th  class="empty-cell1">3</th>
            <th  class="empty-cell1">4</th>
            <th  class="empty-cell1">5</th>
            <th  class="empty-cell1">6</th>
            <th  class="empty-cell1">7</th>
            <th  class="empty-cell1">8</th>
            <th  class="empty-cell1">9</th>
            <th  class="empty-cell1">10</th>
            <th  class="empty-cell2">Total</th>
            <th  class="empty-cell2">PS </th>
            <th  class="empty-cell2">WS </th>
  
            <th  class="empty-cell1">1</th>
            <th  class="empty-cell1">2</th>
            <th  class="empty-cell1">3</th>
            <th  class="empty-cell1">4</th>
            <th  class="empty-cell1">5</th>
            <th  class="empty-cell1">6</th>
            <th  class="empty-cell1">7</th>
            <th  class="empty-cell1">8</th>
            <th  class="empty-cell1">9</th>
            <th  class="empty-cell1">10</th>
            <th  class="empty-cell2">Total</th>
            <th  class="empty-cell2">PS </th>
            <th  class="empty-cell2">WS </th>
  
            <th  class="empty-cell1">1</th>
            <th  class="empty-cell1">2</th>
            <th  class="empty-cell1">3</th>
            <th  class="empty-cell1">4</th>
            <th  class="empty-cell1">5</th>
            <th  class="empty-cell1">6</th>
            <th  class="empty-cell1">7</th>
            <th  class="empty-cell1">8</th>
            <th  class="empty-cell1">9</th>
            <th  class="empty-cell1">10</th>
            <th  class="empty-cell2">Total</th>
            <th  class="empty-cell2">PS </th>
            <th  class="empty-cell2">WS </th>
  
            <th  class="empty-cell1">Midterm</th>
            <th  class="empty-cell1">Finalterm</th>
            <th  class="empty-cell2">Total</th>
            <th  class="empty-cell2">PS </th>
            <th  class="empty-cell2">WS </th>
          </tr>
                     <!-- HIGHEST SCOREEEE-->
          <tr>
              <!-- attendance-->
              <th  class="empty-cell">Highest Score</th>
              <th class="empty-cell" id="attHighest1" contenteditable="true" oninput="updateScores('att')"></th>
              <th class="empty-cell" id="attHighest2" contenteditable="true" oninput="updateScores('att')"></th>
              <th class="empty-cell" id="attHighest3" contenteditable="true" oninput="updateScores('att')"></th>
              <th class="empty-cell" id="attHighest4" contenteditable="true" oninput="updateScores('att')"></th>
              <th class="empty-cell" id="attHighest5" contenteditable="true" oninput="updateScores('att')"></th>
              <th class="empty-cell" id="attHighest6" contenteditable="true" oninput="updateScores('att')"></th>
              <th class="empty-cell" id="attHighest7" contenteditable="true" oninput="updateScores('att')"></th>
              <th class="empty-cell" id="attHighest8" contenteditable="true" oninput="updateScores('att')"></th>
              <th class="empty-cell" id="attHighest9" contenteditable="true" oninput="updateScores('att')"></th>
              <th class="empty-cell" id="attHighest10" contenteditable="true" oninput="updateScores('att')"></th>
              <th class="empty-cell" id="attHighestTotal"></th>
              <th class="empty-cell" id="attPS">100%</th>
              <th class="empty-cell" id="attWS">10%</th>
  
              <!-- written work-->
              <th class="empty-cell" id="wwHighest1" contenteditable="true" oninput="updateScores('ww')"></th>
              <th class="empty-cell" id="wwHighest2" contenteditable="true" oninput="updateScores('ww')"></th>
              <th class="empty-cell" id="wwHighest3" contenteditable="true" oninput="updateScores('ww')"></th>
              <th class="empty-cell" id="wwHighest4" contenteditable="true" oninput="updateScores('ww')"></th>
              <th class="empty-cell" id="wwHighest5" contenteditable="true" oninput="updateScores('ww')"></th>
              <th class="empty-cell" id="wwHighest6" contenteditable="true" oninput="updateScores('ww')"></th>
              <th class="empty-cell" id="wwHighest7" contenteditable="true" oninput="updateScores('ww')"></th>
              <th class="empty-cell" id="wwHighest8" contenteditable="true" oninput="updateScores('ww')"></th>
              <th class="empty-cell" id="wwHighest9" contenteditable="true" oninput="updateScores('ww')"></th>
              <th class="empty-cell" id="wwHighest10" contenteditable="true" oninput="updateScores('ww')"></th>
              <th class="empty-cell" id="wwHighestTotal"></th>
              <th class="empty-cell" id="wwPS">100%</th>
              <th class="empty-cell" id="wwWS">20%</th>
  
              <!-- performance tasks-->
              <th class="empty-cell" id="ptHighest1" contenteditable="true" oninput="updateScores('pt')"></th>
              <th class="empty-cell" id="ptHighest2" contenteditable="true" oninput="updateScores('pt')"></th>
              <th class="empty-cell" id="ptHighest3" contenteditable="true" oninput="updateScores('pt')"></th>
              <th class="empty-cell" id="ptHighest4" contenteditable="true" oninput="updateScores('pt')"></th>
              <th class="empty-cell" id="ptHighest5" contenteditable="true" oninput="updateScores('pt')"></th>
              <th class="empty-cell" id="ptHighest6" contenteditable="true" oninput="updateScores('pt')"></th>
              <th class="empty-cell" id="ptHighest7" contenteditable="true" oninput="updateScores('pt')"></th>
              <th class="empty-cell" id="ptHighest8" contenteditable="true" oninput="updateScores('pt')"></th>
              <th class="empty-cell" id="ptHighest9" contenteditable="true" oninput="updateScores('pt')"></th>
              <th class="empty-cell" id="ptHighest10" contenteditable="true" oninput="updateScores('pt')"></th>
              <th class="empty-cell" id="ptHighestTotal"></th> 
              <th class="empty-cell" id="ptPS">100%</th>
              <th class="empty-cell" id="ptWS">40%</th>
  
              <!-- examination-->
              <th class="empty-cell" id="exHighest1" contenteditable="true" oninput="updateScores('ex')"></th>
              <th class="empty-cell" id="exHighest2" contenteditable="true" oninput="updateScores('ex')"></th>
              <th class="empty-cell" id="exHighestTotal"></th>
              <th class="empty-cell" id="exPS">100%</th>
              <th class="empty-cell" id="exWS">30%</th>
          </tr>
      </thead>

      
      <tbody id="studentRows">
  
            <!-- Rows will be added dynamically here -->
         
      </tbody>
  </table>

</div>


 
<button id="addRowBtn" onclick="addStudentRow()">Add Student</button>
<script src="{{ asset('js/script.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>




<script>
const table = document.querySelector('table');

table.addEventListener('input', function (event) {
    const target = event.target;

    if (target.tagName === 'TD' && target.contentEditable === "true") {
        const studentId = target.closest('tr').getAttribute('data-student-id');
        const column = target.id.split('Highest')[0]; // e.g., "att", "ww"
        const score = target.innerText.trim();

        if (score) {
            saveStudentData(studentId, column, score);
        }
    }
});

function saveStudentData(studentId, column, score) {
    axios.post('{{ route("employee.saveStudentGrade") }}', {
        student_id: studentId,
        column_name: column + '_highest', // e.g., "att_highest"
        value: score,
    }, {
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
    })
    .then(response => {
        if (response.data.success) {
            console.log('Grade updated successfully!');
        } else {
            console.error(response.data.message);
        }
    })
    .catch(error => {
        console.error('Error saving grade:', error.response ? error.response.data : error);
    });
}

function saveToLocalStorage() {
    const studentRows = document.getElementById("studentRows");
    const students = Array.from(studentRows.getElementsByTagName("tr")).map((row) => {
        return {
            studentId: row.id,
            cells: Array.from(row.cells).map(cell => cell.textContent.trim())
        };
    });
    localStorage.setItem("studentRecords", JSON.stringify(students));
}

function loadFromLocalStorage() {
    const studentRows = document.getElementById("studentRows");
    const records = JSON.parse(localStorage.getItem("studentRecords")) || [];
    studentRows.innerHTML = ""; // Clear current rows

    records.forEach(record => {
        const row = document.createElement("tr");
        row.id = record.studentId;

        record.cells.forEach(cellText => {
            const cell = document.createElement("td");
            cell.contentEditable = "true";
            cell.textContent = cellText;
            cell.addEventListener("input", saveToLocalStorage); // Save changes
            row.appendChild(cell);
        });

        studentRows.appendChild(row);
    });
}
</script>




</script>


  
    <div class="footer">
        NSTP SERVICE RECORDS
    </div>
</body>
</html>
