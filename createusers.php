<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joy of PHP - Creating the 'users' table</title>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h2 {
            color: #333;
        }
        p {
            color: #555;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <img src="joy_logo.jpg" alt="The Joy of PHP" width="809" height="87">
    <h2>Creating the 'users' table in the 'Cars' database</h2>

    <?php
    /**
     * Joy of PHP sample code
     * Demonstrates how to add a table to an existing database and insert records.
     */
    include 'db.php';

    try {
        // Select the database
        if (!$mysqli->select_db("Cars")) {
            throw new Exception("Unable to select the Cars database: " . $mysqli->error);
        }
        echo "<p class='success'>Selected the Cars database successfully.</p>";

        // SQL query to create the table
        $createTableQuery = "
            CREATE TABLE IF NOT EXISTS `users` (
                `id` INT(4) NOT NULL AUTO_INCREMENT,
                `username` VARCHAR(65) NOT NULL,
                `password` VARCHAR(65) NOT NULL,
                `role` VARCHAR(65) NOT NULL,
                PRIMARY KEY (`id`)
            )
        ";

        if ($mysqli->query($createTableQuery) === TRUE) {
            echo "<p class='success'>Database table 'users' created successfully.</p>";
        } else {
            throw new Exception("Error creating table: " . $mysqli->error);
        }

        // Insert a record for Sam
        $insertQuery = $mysqli->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $username = 'Sam';
        $password = 'pw123';
        $role = 'Owner';

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $insertQuery->bind_param("sss", $username, $hashedPassword, $role);

        if ($insertQuery->execute()) {
            echo "<p class='success'>Sam's record was inserted into the 'users' table successfully.</p>";
        } else {
            throw new Exception("Error inserting Sam's record: " . $mysqli->error);
        }

        $insertQuery->close();

    } catch (Exception $e) {
        echo "<p class='error'>An error occurred: " . $e->getMessage() . "</p>";
    } finally {
        $mysqli->close();
    }

    include 'footer.php';
    ?>
</body>
</html>


