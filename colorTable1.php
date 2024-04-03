<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Combined Tables</title>
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
        width: 80%
    }

    .Table2 th, .Table2 td {
        border: 1px solid #dddddd;
        padding: 8px;
        text-align: center;
    }
</style>
</head>
<body>

<!-- First Table -->
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
</script>

<!-- Second Table -->
<table class="Table2">
<?php
// Define the size of the table (number of rows and columns)
$numRows = 5;
$numCols = 5;

// Function to convert number to letter (1-based index)
function numberToLetter($number) {
    return chr($number + 64); // A is ASCII 65
}

// Generate the table headers (letters)
echo "<tr><th></th>"; // Empty cell for the upper-left corner
for ($col = 1; $col <= $numCols; $col++) {
    echo "<th>" . numberToLetter($col) . "</th>";
}
echo "</tr>";

// Generate the table rows (numbers)
for ($row = 1; $row <= $numRows; $row++) {
    echo "<tr>";
    echo "<th>$row</th>"; // Numbered cell for the leftmost column
    for ($col = 1; $col <= $numCols; $col++) {
        echo "<td></td>"; // Empty cell
    }
    echo "</tr>";
}
?>


</body>
</html>
