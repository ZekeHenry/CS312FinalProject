<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>TableColor</title>
<link rel="stylesheet" type="text/css" href="./style.css">
<header>
<img class="floatLEft"src="./photos/PhPantomsLogo.png" alt="Company Logo of Purple Phant
            om with PHP letters on it" style="width:80px;height:80px;">
        
        <nav>
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="colors.php">Color Generation</a>
        </nav>
        <h1>Color Generation</h1>
    </header>
<style>
    /* Styling for the first table */
    .Table1 {
        width: 90%; /* Adjust width as needed */
        margin: 20px auto; /* Center the table */
    }

    .Table1 th, .Table1 td {
        border: 1px solid #dddddd;
        padding: 8px;
    }

    .Table1 td:first-child {
        width: 20%; /* Set width of the first column */
    }

    .Table1 td:last-child {
        width: 80%; /* Set width of the second column */
    }

    #message {
        color: red;
        margin-top: 10px;
    }

    /* Styling for the second table */
    .Table2 {
        border-collapse: collapse;
        margin: 20px auto; /* Center the table */
    }

    .Table2 th, .Table2 td {
        border: 3px solid #dddddd;
        padding: 8px;
        width: 10px;
        height: 10px;
    }

    /* Styling for content class */
    .content {
        width: 50px; /* Adjust width as needed */
        height: 50px; /* Adjust height as needed */
    }
</style>
</head>
<body>
<div id="print">
<!-- First Table -->
<h1>Color Table!</h1>
please enter a size for your table:
<select id="selectNumColors" class="selectNumColors"></select>
<table class="Table1" id="table1">
</table>

<script>
  // Function to generate dropdown options
  function generateOptions(selectedColor) {
    const colors = ["red", "orange", "yellow", "green", "blue", "Indigo", "violet", "brown", "black", "white"];
    let options = "";
    colors.forEach(color => {
      const selected = (selectedColor === color) ? "selected" : "";
      options += `<option value='${color}' ${selected}>${color}</option>`;
    });
    return options;
  }

  // Function to update the color cell based on dropdown selection
  function updateDropdowns(selectElement) {
    const colorIndex = selectElement.parentNode.parentNode.rowIndex - 1; 
    const color = selectElement.value;
    const colorCell = document.getElementById(`colorCell${colorIndex}`);
    colorCell.style.backgroundColor = color;
  }

  // Pre-selected color values
  const preSelectedColors = ["red", "orange", "yellow", "green", "blue"];

  // Populate selectNumColors dropdown with integers from 1 to the count of pre-selected colors
  function populateNumColorsDropdown() {
    const selectNumColors = document.getElementById('selectNumColors');
    const count = preSelectedColors.length;
    for (let i = 1; i <= count; i++) {
      const option = document.createElement('option');
      option.value = i;
      option.text = i;
      selectNumColors.appendChild(option);
    }
  }
  populateNumColorsDropdown();

  // Generate rows for each color with dropdown menus
  function generateColorTable() {
    var colorSize = document.getElementById("selectNumColors").value;
    const table = document.getElementById('table1');
    table.innerHTML = ''; // Clear existing table content
    preSelectedColors.slice(0, colorSize).forEach((color, index) => {
      const row = table.insertRow();
      const cell1 = row.insertCell(0);
      const cell2 = row.insertCell(1);
      cell1.innerHTML = `<select onchange='updateDropdowns(this)'>${generateOptions(color)}</select>`;
      cell2.id = `colorCell${index}`;
      cell2.style.backgroundColor = color;
    });
  }
  generateColorTable();

  // Event listener to update color table when selectNumColors value changes
  document.getElementById('selectNumColors').addEventListener('change', generateColorTable);
</script>

<div id="message"></div>

<script>
// Function to update dropdown menus
function updateDropdowns(select) {
    const selectedColors = [];
    const selects = document.querySelectorAll('select');
    selects.forEach((selectElement) => {
        if (selectElement !== select) {
            selectedColors.push(selectElement.value);
        }
    });

    if (selectedColors.includes(select.value)) {
        select.value = select.dataset.previousValue || '';
        document.getElementById('message').textContent = "No two drop downs can select the same color at the same time. Reverted to previous value.";
    } else {
        select.dataset.previousValue = select.value;
        const rowIndex = select.parentElement.parentElement.rowIndex;
        const colorCell = document.getElementById(`colorCell${rowIndex}`);
        colorCell.textContent = ''; // Clear previous content
        colorCell.style.backgroundColor = select.value; // Set background color
        document.getElementById('message').textContent = ''; // Clear message if no conflict
    }
}

</script>

<script>
// Function to update Table2 size
function updateTableSize() {
    var size = document.getElementById("tableSizeDropdown").value;
    var numSlots = size * size;
    var numRows = numCols = size;

    var table = document.querySelector('.Table2');
    table.innerHTML = ''; // Clear existing table content

    // Generate the table headers (letters)
    var headerRow = "<tr><th></th>";
    for (var col = 1; col <= numCols; col++) {
        headerRow += "<th><div class='content'>" + numberToLetter(col) + "</th>";
    }
    headerRow += "</tr>";
    table.innerHTML += headerRow;

    // Generate the table rows (numbers)
    for (var row = 1; row <= numRows; row++) {
        var rowContent = "<tr>";
        rowContent += "<th><div class='content'>" + row + "</th>"; // Numbered cell for the leftmost column
        for (var col = 1; col <= numCols; col++) {
            rowContent += "<td><div class='content'></td>"; // Empty cell
        }
        rowContent += "</tr>";
        table.innerHTML += rowContent;
    }
}

// Function to convert number to letter (1-based index)
function numberToLetter(number) {
    return String.fromCharCode(number + 64); // A is ASCII 65
}
</script>

<h1>Letters and Numbers Table!</h1>

<!-- Dropdown to select Table2 size -->
Please select a size for your table:
<select id="tableSizeDropdown" onchange="updateTableSize()">
    <?php
    // Generate options for table size
    for ($i = 1; $i <= 26; $i++) {
        echo "<option value='$i'>$i</option>";
    }
    ?>
</select>

<!-- Second Table -->
<table class="Table2">
</table>
</div>
<?php
include 'printButton.html';
?>
</body>
</html>
