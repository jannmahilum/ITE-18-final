document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('search-bar');
    const resetButton = document.getElementById('reset-btn');
    const studentRows = document.getElementById('studentRows');
  
    // Initial display of the "All" button
    let allCount = studentRows.children.length;
    resetButton.textContent = allCount > 0 ? 'All' : 'ALL';
  
    searchInput.addEventListener('input', () => {
        const searchValue = searchInput.value.toLowerCase();
        const students = studentRows.getElementsByTagName('tr');
        let foundCount = 0;
  
        Array.from(students).forEach(row => {
            const studentId = row.cells[0].textContent.toLowerCase();
            if (studentId.includes(searchValue)) {
                row.style.display = ''; // Show row
                foundCount++;
            } else {
                row.style.display = 'none'; // Hide row
            }
        });
  
        // Update the reset button with the number of results found
        resetButton.textContent = foundCount > 0 ? foundCount : 'No Results';
    });
  
    // Reset the search
    resetButton.addEventListener('click', () => {
        searchInput.value = '';
        const students = studentRows.getElementsByTagName('tr');
  
        Array.from(students).forEach(row => {
            row.style.display = ''; // Show all rows
        });
  
        // Reset the button to show "All" again
        resetButton.textContent = 'All';
    });
  });
  
  
  
  
  
  
  
  
  
  
  
  
  
  // Function to dynamically add a new student row
  function addStudentRow() {
      const studentRows = document.getElementById("studentRows");
      
      // Generate a unique ID for the row
      const studentId = Date.now();
      
      // Create a new table row
      const row = document.createElement("tr");
      row.id = `row_${studentId}`;
      
      // Populate the row with editable columns
      row.innerHTML = `
        <td contenteditable="true" id="studentID_${studentId}"></td>
        <td colspan="2" contenteditable="true" id="studentName_${studentId}"></td>
        ${createEditableColumns('att', studentId)}
        ${createEditableColumns('ww', studentId)}
        ${createEditableColumns('pt', studentId)}
        ${createEditableColumns('ex', studentId, true)} <!-- Pass true for examination -->
        <td id="row_${studentId}_semesterGrade"></td>
        <td id="row_${studentId}_status"></td>
      `;
      
      studentRows.appendChild(row);
      updateHighestScoreTotal("att");
      updateHighestScoreTotal("ww");
      updateHighestScoreTotal("pt");
      updateHighestScoreTotal("ex");
      }
  
  
  
  
  
  
  
  
  
  
  
  
  
      
      
      // Function to create editable columns for each grading section (with adjustment for exam)
      function createEditableColumns(section, studentId, isExam = false) {
      let columns = "";
      const inputCount = isExam ? 2 : 10; // Correctly set inputCount to 2 for exam
      
      for (let i = 1; i <= inputCount; i++) {
      const idSuffix = isExam
          ? i === 1
              ? "Midterm"
              : "Final"
          : `${i}`;
      
      columns += `    
          <td contenteditable="true" id="row_${studentId}_${section}${idSuffix}" oninput="updateScores('${section}', '${studentId}')"></td>
      `;
      }
      
  
  
  
      
      // Search functionality
      document.getElementById('search-bar').addEventListener('input', function () {
          const searchValue = this.value.toLowerCase();  // Convert the input to lowercase for case-insensitive search
          const rows = document.querySelectorAll('#records-body tr');  // Select all rows in the table
        
          rows.forEach(row => {
            const studentID = row.cells[0].textContent.toLowerCase();  // Get the text content of the Student ID cell
            row.style.display = studentID.includes(searchValue) ? '' : 'none';  // Show or hide the row based on the search value
          });
        });
        
        // Reset filter
        document.getElementById('reset-btn').addEventListener('click', function () {
          document.getElementById('search-bar').value = '';  // Clear the search bar
          const rows = document.querySelectorAll('#records-body tr');  // Select all rows
          rows.forEach(row => (row.style.display = ''));  // Show all rows
        });
        
      
      
      // Add Total, PS, and WS columns for all sections
      columns += `
      <td id="row_${studentId}_${section}Total"></td> 
      <td id="row_${studentId}_${section}PS"></td>
      <td id="row_${studentId}_${section}WS"></td>
      `;
      return columns;
      }
      
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  function updateScores(section, studentId) {
      let totalStudentScore = 0;
      let totalHighestScore = 0;
  
      // Handle Examination Section
      if (section === "ex") {
          const midtermCell = document.getElementById(`row_${studentId}_${section}Midterm`);
          const finalCell = document.getElementById(`row_${studentId}_${section}Final`);
  
          // Get student scores
          const midtermScore = parseFloat(midtermCell?.innerText.trim()) || 0;
          const finalScore = parseFloat(finalCell?.innerText.trim()) || 0;
  
          // Fetch the highest scores directly from the table
          const highestMidtermCell = document.getElementById(`${section}HighestMidterm`);
          const highestFinalCell = document.getElementById(`${section}HighestFinal`);
  
          const highestMidterm = parseFloat(highestMidtermCell?.innerText.trim()) || 0;
          const highestFinal = parseFloat(highestFinalCell?.innerText.trim()) || 0;
  
          // Calculate totals
          totalStudentScore = midtermScore + finalScore;
          totalHighestScore = highestMidterm + highestFinal;
  
          // Update total score cell
          const totalCell = document.getElementById(`row_${studentId}_${section}Total`);
          if (totalCell) {
              totalCell.innerText = totalStudentScore;
          }
  
          // Calculate and Update PS (Percentage Score)
          const psCell = document.getElementById(`row_${studentId}_${section}PS`);
          if (psCell) {
              if (totalHighestScore > 0) {
                  const percentageScore = ((totalStudentScore / totalHighestScore) * 100).toFixed(2);
                  psCell.innerText = percentageScore;
              } else {
                  psCell.innerText = "0";
              }
          }
  
          // Calculate and Update WS (Weighted Score)
          const wsCell = document.getElementById(`row_${studentId}_${section}WS`);
          if (wsCell) {
              if (totalHighestScore > 0) {
                  const weightedScore = (
                      (totalStudentScore / totalHighestScore) *
                      getSectionWeight(section)
                  ).toFixed(2);
                  wsCell.innerText = weightedScore;
              } else {
                  wsCell.innerText = "0";
              }
          }
      } else {
          // Handle other sections (Attendance, Written Work, etc.)
          for (let i = 1; i <= 10; i++) {
              const cell = document.getElementById(`row_${studentId}_${section}${i}`);
              const highestCell = document.getElementById(`${section}Highest${i}`);
              const score = parseFloat(cell?.innerText.trim()) || 0;
              const highestScore = parseFloat(highestCell?.innerText.trim()) || 0;
              totalStudentScore += score;
              totalHighestScore += highestScore;
          }
  
          // Update Total Score
          const totalCell = document.getElementById(`row_${studentId}_${section}Total`);
          if (totalCell) {
              totalCell.innerText = totalStudentScore;
          }
  
          // Calculate PS (Percentage Score)
          const psCell = document.getElementById(`row_${studentId}_${section}PS`);
          if (psCell) {
              if (totalHighestScore > 0) {
                  const percentageScore = ((totalStudentScore / totalHighestScore) * 100).toFixed(2);
                  psCell.innerText = percentageScore;
              } else {
                  psCell.innerText = "0";
              }
          }
  
          // Calculate WS (Weighted Score)
          const wsCell = document.getElementById(`row_${studentId}_${section}WS`);
          if (wsCell) {
              if (totalHighestScore > 0) {
                  const weightedScore = (
                      (totalStudentScore / totalHighestScore) *
                      getSectionWeight(section)
                  ).toFixed(2);
                  wsCell.innerText = weightedScore;
              } else {
                  wsCell.innerText = "0";
              }
          }
      }
  
      updateSemesterGrade(studentId); // Update overall grade
  }
    
    
      
      
      
      
      
      
      
      
    function getSectionWeight(section) {
      switch (section) {
          case 'att': return 10; // Attendance weight
          case 'ww': return 20;  // Written Work weight
          case 'pt': return 40;  // Performance Task weight
          case 'ex': return 30;  // Examination weight
          default: return 0;
      }
  }
  
  
  
  
  
  
  
  
  
  
  
  function updateSemesterGrade(studentId) {
      const sections = ["attWS", "wwWS", "ptWS", "exWS"];
      let totalWS = 0;
  
      sections.forEach((section) => {
          const wsCell = document.getElementById(`row_${studentId}_${section}`);
          if (!wsCell) {
              console.error(`WS cell not found: row_${studentId}_${section}`);
              return;
          }
          totalWS += Number(wsCell.innerText) || 0;
      });
  
      const semesterGrade = Math.round(totalWS);
      const semesterGradeCell = document.getElementById(`row_${studentId}_semesterGrade`);
      if (semesterGradeCell) {
          semesterGradeCell.innerText = semesterGrade;
      } else {
          console.error(`Semester grade cell not found: row_${studentId}_semesterGrade`);
      }
  
      const status = semesterGrade >= 75 ? "Passed" : "Failed";
      const statusCell = document.getElementById(`row_${studentId}_status`);
      if (statusCell) {
          statusCell.innerText = status;
  
          // Add the appropriate class for the status
          if (status === "Passed") {
              statusCell.classList.add("passed");
              statusCell.classList.remove("failed");
          } else {
              statusCell.classList.add("failed");
              statusCell.classList.remove("passed");
          }
      } else {
          console.error(`Status cell not found: row_${studentId}_status`);
      }
  }
  
      
  
  
  
  
  
  
  
  
      function updateHighestScoreTotal(section) {
      let highestScoreTotal = 0;
      const inputCount = section === "ex" ? 2 : 10; // Correctly set inputCount to 2 for exam
      
      for (let i = 1; i <= inputCount; i++) {
      const highestScore =
        parseFloat(document.getElementById(`${section}Highest${i}`).innerText.trim()) ||
        0;
      highestScoreTotal += highestScore;
      }
      
      const highestScoreTotalCell = document.getElementById(`${section}HighestTotal`);
      if (highestScoreTotalCell) {
      highestScoreTotalCell.innerText = Math.round(highestScoreTotal);
      }
      }
      
  
  
  
  
  
  
  
  
  
  
  
      
      document.addEventListener("input", function (event) {
      if (
      event.target.id.startsWith("attHighest") ||
      event.target.id.startsWith("wwHighest") ||
      event.target.id.startsWith("ptHighest") ||
      event.target.id.startsWith("exHighest")
      ) {
      updateHighestScoreTotal("att");
      updateHighestScoreTotal("ww");
      updateHighestScoreTotal("pt");
      updateHighestScoreTotal("ex");
      }
      });
      
      window.onload = function () {
      for (let i = 0; i < 15; i++) {
      addStudentRow();
      }
      updateHighestScoreTotal("att");
      updateHighestScoreTotal("ww");
      updateHighestScoreTotal("pt");
      updateHighestScoreTotal("ex");
      };
      
      // Keyboard navigation for editable cells
      document.addEventListener("keydown", function (event) {
      const activeElement = document.activeElement;
      
      if (
      activeElement.tagName === "TD" &&
      activeElement.contentEditable === "true"
      ) {
      let nextCell;
      const parentRow = activeElement.parentElement;
      
      if (event.key === "ArrowRight") {
        nextCell = activeElement.nextElementSibling;
      } else if (event.key === "ArrowLeft") {
        nextCell = activeElement.previousElementSibling;
      } else if (event.key === "ArrowDown") {
        nextCell = parentRow.nextElementSibling?.children[activeElement.cellIndex];
      } else if (event.key === "ArrowUp") {
        nextCell = parentRow.previousElementSibling?.children[activeElement.cellIndex];
      } else if (event.key === "Enter") {
        nextCell =
          activeElement.nextElementSibling ||
          parentRow.nextElementSibling?.children[activeElement.cellIndex];
      }
      
      if (nextCell) {
        nextCell.focus();
        event.preventDefault();
      }
      }
      });
      