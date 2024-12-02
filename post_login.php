<?php
/**
 * Joy of PHP sample code
 * Demonstrates how to process a login form securely
 */

// Include database connection
include 'db.php';

// Start the session securely
session_start();
if (session_status() !== PHP_SESSION_ACTIVE) {
    die("Unable to start a secure session");
}

// Select a database
if (!$mysqli->select_db("Cars")) {
    die("Error selecting database: " . $mysqli->error);
}

// Retrieve and sanitize input
$myusername = filter_input(INPUT_POST, 'myusername', FILTER_SANITIZE_STRING);
$mypassword = filter_input(INPUT_POST, 'mypassword', FILTER_SANITIZE_STRING);

if (!$myusername || !$mypassword) {
    die("Username or password cannot be empty.");
}

// Prepare and execute the query
$query = "SELECT * FROM Users WHERE username = ?";
$stmt = $mysqli->prepare($query);

if (!$stmt) {
    die("Prepare failed: " . $mysqli->error);
}

$stmt->bind_param('s', $myusername);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Verify password
    if (password_verify($mypassword, $user['password'])) {
        // Register session variables
        $_SESSION['MyUserName'] = $myusername;
        $_SESSION['Role'] = $user['role'];

        // Redirect to success page
        header("Location: login_success.php");
        exit;
    } else {
        echo "Invalid password.";
    }
} else {
    echo "Invalid username or password.";
}

// Clean up
$stmt->close();
$mysqli->close();
?>
<?php
$password = 'user_plain_text_password'; // User-provided password

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Store $hashedPassword in your database