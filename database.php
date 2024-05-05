<?php
// Database connection
    $servername = "faure:3306";
    $username = "zehenry";
    $password = "835884197";
    $dbname = "zehenry";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if colors table exists if not create it
    $sql = "CREATE TABLE IF NOT EXISTS colors (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        color VARCHAR(30) NOT NULL UNIQUE,
        hex VARCHAR(30) NOT NULL UNIQUE
    )";

    if ($conn->query($sql) !== TRUE) {
        echo "Error creating table: " . $conn->error;
    }

    // Insert base colors
    $baseColors = [
        ['Red', '#FF0000'],
        ['Orange', '#FF8F00'],
        ['Yellow', '#FFFF00'],
        ['Green', '#00FF00'],
        ['Blue', '#0000FF'],
        ['Purple', '#8000FF'],
        ['Grey', '#808080'],
        ['Brown', '#964B00'],
        ['Black', '#000000'],
        ['Teal', '#008080']
    ];

    foreach ($baseColors as $color) {
        // Check if color already exists
        $checkSql = "SELECT * FROM colors WHERE color = ?";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bind_param("s", $color[0]);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows == 0) {
            // Color does not exist, so insert it
            $insertSql = "INSERT INTO colors (color, hex) VALUES (?, ?)";
            $insertStmt = $conn->prepare($insertSql);
            $insertStmt->bind_param("ss", $color[0], $color[1]);

            if ($insertStmt->execute() !== TRUE) {
                throw new Exception("Error inserting base color: " . $conn->error);
            }
        }
    }
?>