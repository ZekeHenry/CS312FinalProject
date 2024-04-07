<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>TableColor</title>
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
        width: 200px; /* Set a fixed width for the table */
        height: 200px;
    }




    .Table2 th, .Table2 td {
        border: 3px solid #dddddd;
        padding: 8px;
        text-align: center;
    }
</style>
</head>
<body>


<div id="print">
<!-- First Table -->
<h1>Color Table!</h1>
<table class="Table1">
   
    <?php
    // Function to generate dropdown options
    function generateOptions($selectedColor) {
        $colors = array("red", "orange", "yellow", "green", "blue", "purple", "grey", "brown", "black", "teal");
        $options = "";
        foreach ($colors as $color) {
            $selected = ($selectedColor === $color) ? "selected" : "";
            $options .= "<option value='$color' $selected>$color</option>";
        }
        return $options;
    }




    // Pre-selected color values
    $preSelectedColors = array("red", "orange", "yellow", "green", "blue"); // Example pre-selected colors

    ?>
    <select id="getNumcolors">
        <?php
        for($i = 1; $i <= count($preSelectedColors); $i++){
            echo "<option value='$i'>$i</option>";
        }
        ?>
    </select>
    <?php




    // Generate rows for each color with dropdown menus
   
    $numColors = count($preSelectedColors);
    for ($i = 0; $i < $numColors; $i++) {
        echo "<tr>";
        echo "<td><select onchange='updateDropdowns(this)'>" . generateOptions($preSelectedColors[$i]) . "</select></td>";
        echo "<td id='colorCell$i' style='background-color:" . $preSelectedColors[$i] . "'></td>"; // Empty content for color column
        echo "</tr>";
    }
    ?>
</table>




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
            rowContent += "<td></td>"; // Empty cell
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







