// Function to handle row approval
function approveRow(rowId) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
        // Display success message
        alert("Row approved successfully!");
       
        // Refresh the table
        fetchData();
      }
    };
    xhr.open("GET", "approve_row.php?id=" + rowId, true);
    xhr.send();
  }
  
  // Function to handle row cancellation
  function cancelRow(rowId) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
        // Display success message
        alert("Row canceled successfully!");
        // Refresh the table
        fetchData();
      }
    };
    xhr.open("GET", "cancel_row.php?id=" + rowId, true);
    xhr.send();
  }
  
  // Function to fetch and display data using AJAX
  function fetchData() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
        document.getElementById("table-container").innerHTML = xhr.responseText;
      }
    };
    xhr.open("GET", "fetch data.php", true);
    xhr.send();
  }
  
  // Initial load of data
  fetchData();
  