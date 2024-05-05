<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
    .Table1 {
        width: 90%; 
        margin: 20px auto; 
    }
    .Table1 th, .Table1 td {
        border: 1px solid #dddddd;
        padding: 8px;
    }
    .Table1 td:first-child {
        width: 20%; 
    }

    .Table1 td:last-child {
        width: 80%;
    }
    #message {
        color: red;
        margin-top: 10px;
    }
    .Table2 {
        border-collapse: collapse;
        margin: 20px auto; 
    }
    .Table2 th, .Table2 td {
        border: 3px solid #dddddd;
        padding: 8px;
        width: 50px;
        height: 50px;
    }
    .content {
        width: 50px; 
        height: 50px; 
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
const preSelectedColors = ["red", "orange", "yellow", "green", "blue", "purple", "grey", "brown", "black", "teal"];
var currentColor = preSelectedColors[0]; // Default to first color
var listDisplay = null;

document.addEventListener('DOMContentLoaded', function() {
    listDisplay = document.getElementById('coloredCellsList');
    populateNumColorsDropdown();
    generateColorTable(); // Initializes with red selected
    document.getElementById('selectNumColors').addEventListener('change', function() {
        generateColorTable(); // Re-generate table when dropdown changes
        updateInitialSelection(); 
    });
});

function updateInitialSelection() {
    const initialRadio = document.querySelector("input[type='radio'][value='red']");
    if (initialRadio) {
        handleColorSelection(initialRadio);
    }
}

function generateOptions(selectedColor) {
    return preSelectedColors.map(color =>
        `<option value='${color}' ${selectedColor === color ? "selected" : ""}>${color}</option>`
    ).join('');
}


function populateNumColorsDropdown() {
    const selectNumColors = document.getElementById('selectNumColors');
    for (let i = 1; i <= preSelectedColors.length; i++) {
        selectNumColors.appendChild(new Option(i, i));
    }
}
function updateDropdownAndRadio(selectElement, event) {
    const radioElement = selectElement.parentNode.querySelector('input[type="radio"]');
    if (radioElement) {
        radioElement.value = selectElement.value;  // Sync radio button's value with dropdown
        handleColorSelection(radioElement);
    }
    event.stopPropagation();  // Prevent triggering the table's click event
}


function updateDropdowns(selectElement) {
    currentColor = selectElement.value;
    updateColoredCellsInTable2(); // Update all colored cells in Table2
}
function handleColorSelection(radioElement) {
    const selectElement = radioElement.nextElementSibling;
    currentColor = selectElement.value;
    document.getElementById('radioMessage').textContent = "Selected color: " + currentColor;
    updateColoredCellsInTable2();


    // Clear the display cell of the previously selected radio button if it exists
    if (lastSelectedRadio && lastSelectedRadio !== radioElement) {
        const lastRow = lastSelectedRadio.closest('tr');
        if (lastRow && lastRow.cells[1]) {
            lastRow.cells[1].innerHTML = ''; // Clear previous content
        }
    }

    // Update the variable to the currently selected radio button
    lastSelectedRadio = radioElement;


    // Update the display cell for the newly selected radio button
    const row = radioElement.closest('tr');
    if (row && row.cells[1]) {
        const displayCell = row.cells[1];
        displayCell.style.backgroundColor = currentColor; // Update background color
        displayCell.innerHTML = `Color ${currentColor} is selected<br/>Colored Cells: ${listDisplay.textContent.replace('Colored Cells: ', '')}`;
    }
}


function generateColorTable() {
    const table = document.getElementById('table1');
    table.innerHTML = '';
    preSelectedColors.slice(0, document.getElementById("selectNumColors").value).forEach((color, index) => {
        const row = table.insertRow();
        const cell1 = row.insertCell(0);
        const cell2 = row.insertCell(1);
        const isChecked = color === 'red' ? 'checked' : '';  // Ensure red is checked by default
        cell1.innerHTML = `<input type='radio' name='colorSelector' value='${color}' ${isChecked} onchange='handleColorSelection(this)' />`;
        cell1.innerHTML += `<select onchange='updateDropdownAndRadio(this, event)'>${generateOptions(color)}</select>`;
        cell2.id = `colorCell${index}`;
        cell2.style.backgroundColor = color;
    });
    // Initialize with 'red' selected if exists
    const initialRadio = table.querySelector("input[type='radio'][value='red']");
    if (initialRadio) {
        handleColorSelection(initialRadio);
    }
}
function updateColoredCellsInTable2() {
    const cells = document.querySelectorAll('.Table2 td');
    cells.forEach(cell => {
        if (cell.style.backgroundColor) {
            cell.style.backgroundColor = currentColor;
        }
    });
}
document.addEventListener('click', function(event) {
    if (event.target.tagName === 'TD' && event.target.closest('.Table2')) {
        event.target.style.backgroundColor = event.target.style.backgroundColor === currentColor ? '' : currentColor;
    }
});
populateNumColorsDropdown();
generateColorTable();
document.getElementById('selectNumColors').addEventListener('change', generateColorTable);
</script>
<div id="radioMessage"></div>
<div id="message"></div>
<div id="coloredCellsList">Colored Cells: </div>
<script>
    var lastSelectedRadio = null;
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
    var messageText = document.getElementById('radioMessage').textContent;
    var radioColor = messageText.substring(17);
    function toggleColor($element) {
            if ($element.length === 0) return; // Check if the element exists
            if ($element.css('background-color') === radioColor) {
                $element.css('background-color', ''); // Toggle off the color if already applied
            } else {
                $element.css('background-color', radio); // Apply the selected color
            }
        }
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
        headerRow += "<th>" + numberToLetter(col) + "</th>";
    }
    headerRow += "</tr>";
    table.innerHTML += headerRow;
    // Generate the table rows (numbers)
    for (var row = 1; row <= numRows; row++) {
        var rowContent = "<tr>";
        rowContent += "<th>" + row + "</th>"; // Numbered cell for the leftmost column
        for (var col = 1; col <= numCols; col++) {
            var cellId = numberToLetter(col)  + row; // Unique id for each cell
            rowContent += "<td id='" + cellId + "'></td>"; // Empty cell with id
        }
        rowContent += "</tr>";
        table.innerHTML += rowContent;
    }
}

function numberToLetter(number) {
    return String.fromCharCode(number + 64); 
}

document.addEventListener('click', function(event) {
    if (event.target.tagName === 'TD' && event.target.closest('.Table2')) {
        var cellId = event.target.id;
        manageColoredCellsList(cellId);
    }
});

function manageColoredCellsList(cellId) {
    var coloredCells = listDisplay.textContent.replace('Colored Cells: ', '').split(', ').filter(Boolean);
    coloredCells.sort();

    // Toggle the cell ID in the list
    if (!coloredCells.includes(cellId)) {
        coloredCells.push(cellId);
    } else {
        coloredCells = coloredCells.filter(id => id !== cellId);
    }

    // Update the list display text
    if (coloredCells.length > 0) {
        listDisplay.textContent = 'Colored Cells: ' + coloredCells.join(', ');
    } else {
        listDisplay.textContent = 'Colored Cells: '; 
    }

    // Update the display within the selected cell in the first table
    if (lastSelectedRadio) {
        const row = lastSelectedRadio.closest('tr');
        if (row) {
            const displayCell = row.cells[1];
            displayCell.innerHTML = `Color ${currentColor} is selected<br/>Colored Cells: ${coloredCells.join(', ')}`;
        }
    }
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
