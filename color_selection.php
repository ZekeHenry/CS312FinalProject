<!DOCTYPE html>
<html lang="en_US">
    <?php
    include 'database.php';
    // Handle form submissions
    $colorList = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $action = $_POST['action'];
        $colorName = isset($_POST['colorName']) ? $_POST['colorName'] : null;
        $hex = isset($_POST['hex']) ? $_POST['hex'] : null;

        switch ($action) {
            case 'show':
                // Handle show action
                $sql = "SELECT * FROM colors";
                $result = $conn->query($sql);
                $colorList .= "<ul>";
                while ($row = $result->fetch_assoc()) {
                    $colorList .= "<li>" . $row['color'] . " - " . $row['hex'] . "</li>";
                }
                $colorList .= "</ul>";
                break;
            case 'add':
                // Handle add action
                $sql = "INSERT INTO colors (color, hex) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $colorName, $hex);
                if (!$stmt->execute()) {
                    echo "<script>alert('Error: " . $stmt->error . "');</script>";
                }
                break;
            case 'update':
                // Handle update action
                $newColorName = $_POST['newColorName'];
                $newHex = $_POST['newHex'];
                $sql = "UPDATE colors SET color = ?, hex = ? WHERE color = ? AND hex = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss", $newColorName, $newHex, $colorName, $hex);
                if (!$stmt->execute()) {
                    echo "<script>alert('Error: " . $stmt->error . "');</script>";
                }
                break;
            case 'delete':
                // Handle delete action
                $sql = "SELECT COUNT(*) AS count FROM colors";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                if ($row['count'] > 2) {
                    $sql = "DELETE FROM colors WHERE color = ? AND hex = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ss", $colorName, $hex);
                    if (!$stmt->execute()) {
                        echo "<script>alert('Error: " . $stmt->error . "');</script>";
                    }
                } else {
                    // alert user that they cannot delete the last two colors
                    echo "<script>alert('You cannot delete the last two colors.');</script>";
                }
                break;
        }
    }
    echo "<script>console.log('All colors added to the database:');</script>";
    $conn->close();
    ?>

    <head>
        <meta charset="UTF-8">
        <meta name="Authors" content="Zeke Henry, Carson Calhoun, Adam Rippey, Grayson Morris">
        <meta name="Description" content="A databse to hold user defined colors">
        <meta name="Keywords" content="database, forms, colors">
        <title>Color Selection</title>
        <link rel="stylesheet" type="text/css" href="./style.css">
    </head>

    <body>
        <header>
            <img class="floatLEft"src="./photos/PhPantomsLogo.png" alt="Company Logo of Purple Phant
            om with PHP letters on it" style="width:80px;height:80px;">
        
            <nav>
                <a href="index.php">Home</a>
                <a href="about.php">About</a>
                <a href="colors.php">Color Generation</a>
                <a href="color_selection.php">Color Selection</a>
            </nav>
            <h1>Color Selection Database</h1>
        </header>

        <main>
            <!-- Show Colors Button -->
            <form method="POST" action="color_selection.php">
            <h2>Show Colors in Database</h2>
                <input type="hidden" name="action" value="show">
                <input type="submit" value="Show Colors">
                <?php echo $colorList; ?>
            </form>

            <!-- Add Color Form -->
            <form method="POST" action="color_selection.php">
                <h2>Add Color</h2>
                <label for="addColorName">Color Name:</label>
                <input type="text" id="addColorName" name="colorName" placeholder="White" required>
                <label for="addHex">Hex Value:</label>
                <input type="text" id="addHex" name="hex" placeholder="#FFFFFF" required>
                <input type="hidden" name="action" value="add">
                <input type="submit" value="Add Color">
            </form>

            <!-- Edit Color Form -->
            <form method="POST" action="color_selection.php">
                <h2>Edit Color</h2>
                <label for="editColorName">Current Color Name:</label>
                <input type="text" id="editColorName" name="colorName" placeholder="White" required>
                <label for="editHex">Current Hex Value:</label>
                <input type="text" id="editHex" name="hex" placeholder="#FFFFFF" required>
                <label for="newColorName">New Color Name:</label>
                <input type="text" id="newColorName" name="newColorName" placeholder="White" required>
                <label for="newHex">New Hex Value:</label>
                <input type="text" id="newHex" name="newHex" placeholder="#FFFFFF" required>
                <input type="hidden" name="action" value="update">
                <input type="submit" value="Edit Color">
            </form>

            <!-- Delete Color Form -->
            <form method="POST" action="color_selection.php">
                <h2>Delete Color</h2>
                <label for="deleteColorName">Color Name:</label>
                <input type="text" id="deleteColorName" name="colorName" placeholder="White" required>
                <label for="deleteHex">Hex Value:</label>
                <input type="text" id="deleteHex" name="hex" placeholder="#FFFFFF" required>
                <input type="hidden" name="action" value="delete">
                <input type="submit" value="Delete Color">
            </form>
        </main>
        <style>
            /* Styling for the form */
            form {
                width: 50%;
                margin: 20px auto;
                padding: 20px;
                border: 1px solid #dddddd;
            }

            form h2 {
                margin-bottom: 10px;
            }

            form label {
                display: block;
                margin-bottom: 5px;
            }

            form input[type="submit"] {
                background-color: #4CAF50;
                color: white;
                cursor: pointer;
            }

            form input[type="submit"]:hover {
                background-color: #45a049;
            }

            h1 {
                display: flex;
                flex-direction: column;
                align-items: center;
            }
        </style>
    </body>
</html>

